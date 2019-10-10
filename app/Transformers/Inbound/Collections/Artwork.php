<?php

namespace App\Transformers\Inbound\Collections;

use Illuminate\Database\Eloquent\Model;

use App\Models\Collections\ArtworkDate;

use App\Transformers\Datum;
use App\Transformers\Inbound\CollectionsTransformer;

use App\Transformers\Traits\ConvertsToHtml;

use Carbon\Carbon;

class Artwork extends CollectionsTransformer
{

    use ConvertsToHtml;

    public function syncEx(Model $instance, Datum $datum)
    {
        $this->syncDates($instance, $datum);
    }

    protected function getExtraFields(Datum $datum)
    {
        // TODO: This is supposed to be a string, not an array...
        $copyright_notice = is_array($datum->copyright) ? $datum->copyright[0] : $datum->copyright;

        // Standarize HTML/non-HTML descriptions
        $description = $this->convertToHtml($datum->description);

        return [
            'description' => $description,
            'alt_titles' => $datum->alt_titles,
            'artist_display' => $datum->creator_display,
            'medium_display' => $datum->medium,
            'publication_history' => $datum->publications,
            'exhibition_history' => $datum->exhibitions,
            'copyright_notice' => $copyright_notice,
            'gallery_citi_id' => $datum->gallery_id,
            'internal_department_id' => $datum->department_id,
            // TODO: ArtworkTypes may need to be attached via string comparison
            //'artwork_type_citi_id' => , // Redmine #2431
        ];
    }

    protected function getSync(Datum $datum, $test = false)
    {
        return [
            'categories' => $this->getSyncCategories($datum),
            'terms' => $this->getSyncTerms($datum),

            'artists' => $this->getSyncArtists($datum),
            'places' => $this->getSyncPlaces($datum),
            'catalogues' => $this->getSyncCatalogues($datum),
        ];
    }

    protected function getSyncEx(Datum $datum)
    {
        $now = date('Y-m-d H:i:s');

        return [
            'artwork_dates' => collect($datum->artwork_dates ?? [])->map(function ($date) use ($datum, $now) {
                return [
                    'artwork_citi_id' => $datum->id,
                    'date_earliest' => Carbon::parse($date->date_earliest),
                    'date_latest' => Carbon::parse($date->date_latest),
                    'preferred' => $date->is_preferred,
                    'artwork_date_qualifier_citi_id' => $date->date_qualifier_id,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            })->all(),
        ];
    }

    /**
     * Get an artwork's publish categories for syncing.
     *
     * @return array
     */
    private function getSyncCategories(Datum $datum)
    {
        $categories = collect($datum->category_ids)->map(function ($id) {
            return 'PC-' . $id;
        });

        return $categories;
    }

    /**
     * Get an artwork's index terms for syncing.
     *
     * @return array
     */
    private function getSyncTerms(Datum $datum)
    {
        $pref_terms = collect($datum->pref_term_ids)->map(function ($term_id) {
            return [
                ('TM-' . $term_id) => [
                    'preferred' => true,
                ],
            ];
        });

        $alt_terms = collect($datum->alt_term_ids)->map(function ($term_id) {
            return [
                ('TM-' . $term_id) => [
                    'preferred' => false,
                ],
            ];
        });

        $terms = $pref_terms->concat($alt_terms);
        $terms = $terms->collapse();

        return $terms;
    }

    /**
     * Get an artwork's agents and their roles for syncing.
     *
     * @return array
     */
    private function getSyncArtists(Datum $datum)
    {
        // Worst case: no pivots, nor basic artist
        if (!$datum->artwork_agents && !$datum->creator_id) {
            return [];
        }

        // No pivots, but basic artist
        if (!$datum->artwork_agents && $datum->creator_id) {
            // Default `preferred` to true and `agent_role_citi_id` to 219
            return [
                $datum->creator_id => [
                    'agent_role_citi_id' => $datum->creator_role_id ?? 219,
                    'preferred' => true,
                ],
            ];
        }

        return $this->getSyncPivots($datum, 'artwork_agents', 'agent_id', function ($pivot) {
            return [
                $pivot->agent_id => [
                    'agent_role_citi_id' => $pivot->role_id,
                    'preferred' => $pivot->is_preferred,
                ],
            ];
        });
    }

    /**
     * Attach artwork places, and what happened to the artwork in each place.
     *
     * @TODO Waiting on Redmine #2847 – place normalization for non-"Web Everything" works
     *
     * @return array
     */
    private function getSyncPlaces(Datum $datum)
    {
        return $this->getSyncPivots($datum, 'artwork_places', 'place_id', function ($pivot) {
            return [
                $pivot->place_id => [
                    'artwork_place_qualifier_citi_id' => $pivot->place_qualifier_id,
                    'preferred' => $pivot->is_preferred,
                ],
            ];
        });
    }

    /**
     * Attach catalogue raisonnes within which this artwork was published.
     */
    private function getSyncCatalogues(Datum $datum)
    {
        return $this->getSyncPivots($datum, 'artwork_catalogues', 'catalogue_id', function ($pivot) {
            return [
                $pivot->catalogue_id => [
                    'number' => $pivot->number,
                    'state_edition' => $pivot->state_edition,
                    'preferred' => $pivot->is_preferred,
                ],
            ];
        });
    }

    /**
     * Attach dates to an artwork.
     */
    private function syncDates(Model $instance, Datum $datum)
    {
        $instance->dates()->delete();

        foreach (($datum->artwork_dates ?? []) as $date) {
            ArtworkDate::create([
                'artwork_citi_id' => $datum->id,
                'date_earliest' => Carbon::parse($date->date_earliest),
                'date_latest' => Carbon::parse($date->date_latest),
                'preferred' => $date->is_preferred,
                'artwork_date_qualifier_citi_id' => $date->date_qualifier_id,
            ]);
        }
    }

}
