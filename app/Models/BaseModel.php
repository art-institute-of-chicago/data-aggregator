<?php

namespace App\Models;

use Carbon\Carbon;

use Aic\Hub\Foundation\AbstractModel;

use App\BelongsToManyOrOne;
use App\Scopes\PublishedScope;
use App\Models\Collections\Exhibition;
use App\Models\Shop\Product;
use App\Models\Web\Article;
use App\Models\Web\DigitalCatalog;
use App\Models\Web\DigitalPublicationSection;
use App\Models\Web\EducatorResource;
use App\Models\Web\Event;
use App\Models\Web\EventOccurrence;
use App\Models\Web\Exhibition as WebExhibition;
use App\Models\Web\GenericPage;
use App\Models\Web\PressRelease;
use App\Models\Web\PrintedCatalog;
use App\Models\Web\Highlight;
use App\Models\Web\Sponsor;
use App\Models\Web\StaticPage;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BaseModel extends AbstractModel
{

    use Transformable, Instancable, Documentable, HasFactory;

    /**
     * The name of the field that the source API provides a last updated timestamp in.
     *
     * @var string
     */
    public static $sourceLastUpdateDateField = 'modified_at';

    /**
     * String that indicates the sub-namespace of the child models. Used for dynamic model retrieval.
     *
     * TODO: This isn't entirely accurate, since a model might be drawn from multiple sources.
     *
     * @var string
     */
    protected static $source;

    protected $hasSourceDates = true;

    /**
     * This getter is in Laravel's base `Model` class, or rather, in its `HasAttributes` trait.
     * We override it here as a convenient way to "append" dates. This allows child classes to
     * use the `$casts` property without worrying about overwriting parent definitions in their
     * entirety. This way, casts are additive. If you need to remove dates, just overwrite this
     * method in a child model.
     */
    public function getCasts()
    {
        // Traverse through the class hierarchy of all the child classes and merge together their
        // definitions of the `$casts` attribute. This allows child classes to simple use `$casts`
        // as an additive property without needing to worry about merging with the parent array.
        $casts = parent::getCasts();
        $class = get_called_class();

        while ($class = get_parent_class($class)) {
            $casts = array_merge($casts, get_class_vars($class)['casts']);
        }

        if (!$this->hasSourceDates) {
            return $casts;
        }

        return array_merge($casts, [
            'source_modified_at' => 'datetime',
        ]);
    }

    public function isBoosted()
    {
        return false;
    }

    /**
     * Touch the owning relations of the model.
     * Reindex related models in search index.
     *
     * @return void
     */
    public function touchOwners()
    {
        parent::touchOwners();

        foreach ($this->touches as $relation) {
            if ($this->{$relation} instanceof self) {
                $this->{$relation}->searchable();
            } elseif ($this->{$relation} instanceof Collection) {
                foreach ($this->{$relation}->chunk(50) as $chunk) {
                    $chunk->searchable();
                }
            }
        }
    }

    /**
     * Instantiate a new BelongsToMany relationship.
     *
     * @TODO: Move this to the foundation?
     *
     * @param  string  $table
     * @param  string  $foreignPivotKey
     * @param  string  $relatedPivotKey
     * @param  string  $parentKey
     * @param  string  $relatedKey
     * @param  string  $relationName
     * @return \App\BelongsToManyOrOne
     */
    protected function newBelongsToMany(
        Builder $query,
        Model $parent,
        $table,
        $foreignPivotKey,
        $relatedPivotKey,
        $parentKey,
        $relatedKey,
        $relationName = null
    ) {
        return new BelongsToManyOrOne($query, $parent, $table, $foreignPivotKey, $relatedPivotKey, $parentKey, $relatedKey, $relationName);
    }

    public static function addRestrictContentScopes($isDump = false)
    {
        Article::addGlobalScope(new PublishedScope);
        DigitalCatalog::addGlobalScope(new PublishedScope);
        DigitalPublicationSection::addGlobalScope(new PublishedScope);
        EducatorResource::addGlobalScope(new PublishedScope);
        GenericPage::addGlobalScope(new PublishedScope);
        PressRelease::addGlobalScope(new PublishedScope);
        PrintedCatalog::addGlobalScope(new PublishedScope);
        Highlight::addGlobalScope(new PublishedScope);
        Sponsor::addGlobalScope(new PublishedScope);
        StaticPage::addGlobalScope(new PublishedScope);
        WebExhibition::addGlobalScope(new PublishedScope);

        if ($isDump) {
            Event::addGlobalScope(new PublishedScope);
            EventOccurrence::addGlobalScope(new PublishedScope);
            Product::addGlobalScope(new PublishedScope);
        }

        Exhibition::addGlobalScope('is-web-exhibition-published', function (Builder $builder) {
            // Show all past exhibitions, accounting for some of the funky ways we've catalogued exhibitions in the past
            $builder->where(function ($query) {
                $query->where('date_aic_start', '<=', Carbon::today())
                    ->where(function ($query2) {
                        $query2->where('date_aic_end', '<=', Carbon::today())
                            ->orWhere('date_aic_start', '<', Carbon::createMidnightDate(2011, 1, 1));
                    });
            });

            // For present and future exhibitions, only show if they're published on the web
            // WEB-1419: Using subquery here instead of join to avoid field overrides
            $builder->orWhereIn('citi_id', function ($query) {
                $query->select('datahub_id')
                      ->from('web_exhibitions')
                      ->where('is_published', '=', true);
            });
        });
    }
}
