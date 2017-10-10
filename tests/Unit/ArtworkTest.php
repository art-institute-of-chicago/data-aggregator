<?php

namespace Tests\Unit;

use App\Models\Collections\Artwork;
use App\Models\Collections\Image;
use App\Models\Collections\Category;
use App\Models\Collections\Agent;
use App\Models\Collections\AgentType;

class ArtworkTest extends ApiTestCase
{

    protected $model = Artwork::class;

    protected $route = 'artworks';

    protected $keys = ['lake_guid'];

    /** @test */
    public function it_fetches_essential_artworks()
    {

        $this->make(Artwork::class, ['citi_id' => 185651]);
        $this->make(Artwork::class, ['citi_id' => 183077]);
        $this->make(Artwork::class, ['citi_id' => 151358]);
        $this->make(Artwork::class, ['citi_id' => 99539]);
        $this->make(Artwork::class, ['citi_id' => 189595]);
        $resources = $this->it_fetches_multiple(Artwork::class, 'artworks/essentials');

        $this->assertArrayHasKeys($resources, ['lake_guid'], true);

    }

    /** @test */
    public function it_fetches_images_for_an_artwork()
    {

        $artworkKey = $this->attach(Image::class, 4)->make(Artwork::class);

        $response = $this->getJson('api/v1/artworks/' .$artworkKey .'/images');
        $response->assertSuccessful();

        $images = $response->json()['data'];
        $this->assertCount(4, $images);

        foreach ($images as $image)
        {
            $this->assertArrayHasKeys($image, ['id', 'title', 'content']);
        }
    }

    /** @test */
    public function it_fetches_categories_for_an_artwork()
    {

        $artworkKey = $this->attach(Category::class, 4)->make(Artwork::class);

        $response = $this->getJson('api/v1/artworks/' .$artworkKey .'/categories');
        $response->assertSuccessful();

        $pubcats = $response->json()['data'];
        $this->assertCount(4, $pubcats);

        foreach ($pubcats as $pubcat)
        {
            $this->assertArrayHasKeys($pubcat, ['id', 'title', 'parent_id']);
        }
    }

    public function it_fetches_resources_for_an_artwork()
    {

        $artworkKey = $this->attach([Sound::class, Video::class, Text::class, Link::class], 4)->make(Artwork::class);

        $response = $this->getJson('api/v1/artworks/' .$artworkKey .'/resources');
        $response->assertSuccessful();

        $resources = $response->json()['data'];
        $this->assertCount(16, $resources);

        foreach ($resources as $resource)
        {
            $this->assertArrayHasKeys($resource, ['id', 'title']);
        }
    }

    /** @test */
    public function it_fetches_the_artists_for_an_artwork()
    {

        $artworkKey = $this->attach(Agent::class, 2, 'artists')->make(Artwork::class);

        $response = $this->getJson('api/v1/artworks/' .$artworkKey .'/artists');
        $response->assertSuccessful();

        $artists = $response->json()['data'];
        $this->assertCount(2, $artists);

        foreach ($artists as $artist)
        {
            $this->assertArrayHasKeys($artist, ['id', 'title']);
        }

    }

    /** @test */
    public function it_fetches_the_copyright_representatives_for_an_artwork()
    {

        $copyRepAgentType = $this->make(AgentType::class, ['title' => 'Copyright Representative']);
        $artworkKey = $this->attach(Agent::class, 2, 'copyrightRepresentatives', ['agent_type_citi_id' => $copyRepAgentType])->make(Artwork::class);

        $response = $this->getJson('api/v1/artworks/' .$artworkKey .'/copyrightRepresentatives');
        $response->assertSuccessful();

        $copyrightRepresentatives = $response->json()['data'];
        $this->assertCount(2, $copyrightRepresentatives);

        foreach ($copyrightRepresentatives as $copyrightRepresentative)
        {
            $this->assertArrayHasKeys($copyrightRepresentative, ['id', 'title']);
        }

    }


    /** @test */
    public function it_fetches_the_parts_for_an_artwork()
    {

        $artworkKey = $this->attach(Artwork::class, 2, 'parts')->make(Artwork::class);

        $response = $this->getJson('api/v1/artworks/' .$artworkKey .'/parts');
        $response->assertSuccessful();

        $parts = $response->json()['data'];
        $this->assertCount(2, $parts);

        foreach ($parts as $part)
        {
            $this->assertArrayHasKeys($part, ['id', 'title']);
        }

    }

    /** @test */
    public function it_fetches_the_sets_for_an_artwork()
    {

        $artworkKey = $this->attach(Artwork::class, 2, 'sets')->make(Artwork::class);

        $response = $this->getJson('api/v1/artworks/' .$artworkKey .'/sets');
        $response->assertSuccessful();

        $sets = $response->json()['data'];
        $this->assertCount(2, $sets);

        foreach ($sets as $set)
        {
            $this->assertArrayHasKeys($set, ['id', 'title']);
        }

    }

}
