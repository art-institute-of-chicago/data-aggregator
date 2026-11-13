<?php

namespace Tests\Unit;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use App\Models\Changes\RecordChange;
use App\Models\Changes\RecordSnapshot;
use App\Models\Collections\Agent;
use App\Models\Collections\AgentType;
use App\Models\Collections\Artwork;
use App\Services\ChangeTracker;

class ChangeTrackerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // The artwork factory picks an artist from existing individual agents
        $agentType = $this->make(AgentType::class, ['title' => 'Individual']);
        $this->make(Agent::class, ['agent_type_id' => $agentType->id]);
    }

    #[Test]
    public function it_diffs_fields_that_were_changed_added_or_removed(): void
    {
        $diff = ChangeTracker::diff(
            ['title' => 'Old', 'artist_ids' => [1, 2], 'same' => 'x', 'removed' => 'gone'],
            ['title' => 'New', 'artist_ids' => [2, 1], 'same' => 'x', 'added' => 'here']
        );

        $this->assertEquals([
            'title' => ['Old', 'New'],
            'artist_ids' => [[1, 2], [2, 1]],
            'removed' => ['gone', null],
            'added' => [null, 'here'],
        ], $diff);
    }

    #[Test]
    public function it_baselines_without_logging_on_first_run(): void
    {
        $artwork = $this->make(Artwork::class);

        $this->artisan('changes:detect')->assertSuccessful();

        $this->assertTrue(RecordSnapshot::where('resource', 'artworks')->where('record_id', $artwork->id)->exists());
        $this->assertEquals(0, RecordChange::count());
    }

    #[Test]
    public function it_resumes_an_interrupted_baseline_without_logging(): void
    {
        $artworks = $this->times(2)->make(Artwork::class);

        // Simulate a baseline that only got through the first artwork before stopping
        (new ChangeTracker('artworks'))->track($artworks->take(1), now(), true);

        $this->artisan('changes:detect')->assertSuccessful();

        $this->assertEquals(2, RecordSnapshot::where('resource', 'artworks')->count());
        $this->assertEquals(0, RecordChange::count());
    }

    #[Test]
    public function it_logs_changed_public_fields(): void
    {
        $artwork = $this->make(Artwork::class, ['title' => 'Old Title']);
        $this->artisan('changes:detect')->assertSuccessful();

        $artwork->title = 'New Title';
        $artwork->save();

        $this->artisan('changes:detect')->assertSuccessful();

        $changes = RecordChange::where('record_id', $artwork->id)->get();

        $this->assertCount(1, $changes);
        $this->assertEquals(RecordChange::UPDATED, $changes[0]->event);
        $this->assertEquals('title', $changes[0]->field);
        $this->assertEquals('Old Title', $changes[0]->old_value);
        $this->assertEquals('New Title', $changes[0]->new_value);
    }

    #[Test]
    public function it_ignores_restricted_and_untracked_fields(): void
    {
        $artwork = $this->make(Artwork::class, ['pageviews' => 0]);
        $this->artisan('changes:detect')->assertSuccessful();

        // Affects restricted `pageviews` and untracked `has_not_been_viewed_much` and `updated_at`
        $artwork->pageviews = 100000;
        $artwork->save();

        $this->artisan('changes:detect')->assertSuccessful();

        $this->assertEquals(0, RecordChange::count());

        $snapshot = RecordSnapshot::where('record_id', $artwork->id)->first();
        $this->assertArrayNotHasKeys($snapshot->data, [
            'pageviews',
            'has_not_been_viewed_much',
            'updated_at',
            'timestamp',
        ]);
    }

    #[Test]
    public function it_logs_created_and_deleted_records(): void
    {
        $existing = $this->make(Artwork::class);
        $this->artisan('changes:detect')->assertSuccessful();

        $created = $this->make(Artwork::class);
        $existing->delete();

        $this->artisan('changes:detect')->assertSuccessful();

        $this->assertEquals(RecordChange::CREATED, RecordChange::where('record_id', $created->id)->sole()->event);
        $this->assertEquals(RecordChange::DELETED, RecordChange::where('record_id', $existing->id)->sole()->event);
        $this->assertFalse(RecordSnapshot::where('record_id', $existing->id)->exists());
    }

    #[Test]
    public function it_lists_changes_through_the_api(): void
    {
        $artwork = $this->make(Artwork::class, ['title' => 'Old Title']);
        $this->artisan('changes:detect')->assertSuccessful();

        $artwork->title = 'New Title';
        $artwork->save();
        $this->artisan('changes:detect')->assertSuccessful();

        $response = $this->getJson('api/v1/changes?resource=artworks&ids=' . $artwork->id);
        $response->assertSuccessful();

        $data = $response->json()['data'];
        $this->assertCount(1, $data);
        $this->assertArrayHasKeys($data[0], [
            'id',
            'resource',
            'record_id',
            'event',
            'field',
            'old_value',
            'new_value',
            'detected_at',
        ]);
        $this->assertEquals('New Title', $data[0]['new_value']);

        $this->getJson('api/v1/changes?resource=agents')->assertStatus(400);
        $this->getJson('api/v1/changes?since=not-a-date')->assertStatus(400);
    }
}
