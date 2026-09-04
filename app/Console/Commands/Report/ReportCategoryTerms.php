<?php

namespace App\Console\Commands\Report;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;
use App\Models\Collections\Category;
use App\Models\Collections\CategoryTerm;
use App\Models\Collections\Term;
use Illuminate\Support\Facades\DB;

class ReportCategoryTerms extends BaseCommand
{
    protected $signature = 'report:category-terms';

    protected $description = 'Count category terms (terms and categories) currently used in the collection';

    public function handle()
    {
        $terms = Term::withCount('artworks as artwork_count')
            ->get(['id', 'title', 'subtype']);

        $categories = Category::withCount(['artworks as artwork_count'])
            ->get(['id', 'title', 'subtype']);

        $rows = $terms->concat($categories);

        $this->updateUsageCounts($rows);

        $groups = $rows->where('artwork_count', '>', 0)->groupBy('subtype');

        $knownSubtypes = [
            CategoryTerm::CLASSIFICATION,
            CategoryTerm::MATERIAL,
            CategoryTerm::TECHNIQUE,
            CategoryTerm::STYLE,
            CategoryTerm::SUBJECT,
            CategoryTerm::DEPARTMENT,
            CategoryTerm::THEME,
        ];

        $unknownSubtypes = $groups->keys()
            ->reject(fn ($subtype) => in_array($subtype, $knownSubtypes, true))
            ->sort()
            ->values()
            ->all();

        $subtypes = array_merge($knownSubtypes, $unknownSubtypes);

        $totalTerms = 0;
        $totalAssignments = 0;
        $summary = [];

        foreach ($subtypes as $subtype) {
            $group = $groups->get($subtype);

            if (! $group) {
                continue;
            }

            $rows = $group->sortByDesc('artwork_count')->values();
            $display = $rows->first()->getSubtypeDisplay() ?: ($subtype ?: 'other');

            if ($this->output->isVerbose()) {
                $this->warn(ucfirst($display).':');

                $this->table(['ID', 'Title', 'Artworks'], $rows->map(function ($row) {
                    return [$row->id, $row->title, $row->artwork_count];
                })->all());
            }

            $distinctTerms = $rows->count();
            $assignments = $rows->sum('artwork_count');

            $summary[] = [$display, $distinctTerms, $assignments];

            $totalTerms += $distinctTerms;
            $totalAssignments += $assignments;
        }

        if ($summary && $this->output->isVerbose()) {
            $this->table(['Subtype', 'Distinct terms', 'Total artworks'], $summary);
            $this->info("Grand total: {$totalTerms} distinct terms across {$totalAssignments} artwork-term assignments");
        }
    }

    /**
     * Persist the computed artwork count to `usage_count` on each term/category.
     */
    private function updateUsageCounts($rows)
    {
        $payload = $rows->map(function ($row) {
            return [
                'id' => $row->id,
                'usage_count' => (int) $row->artwork_count,
                'is_category' => (int) $row->is_category,
                'subtype' => $row->subtype,
            ];
        })->all();

        DB::table('category_terms')->upsert($payload, ['id'], ['usage_count']);
    }
}
