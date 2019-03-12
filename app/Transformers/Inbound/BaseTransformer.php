<?php

namespace App\Transformers\Inbound;

use App\Transformers\Datum;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

use App\Transformers\AbstractTransformer;

class BaseTransformer extends AbstractTransformer
{

    /**
     * If this property is true, all fields will be copied from the datum to serve as the
     * basis for custom mappings. If it's false, no fields will be copied – effectively,
     * you'll have to define each field manually via methods like `getExtraFields`.
     *
     * @var boolean
     */
    protected $passthrough = true;

    /**
     * If passthrough is true, fields listed here will not be passed through. Meant to avoid
     * conflicts when overriding getIds, getTitle, etc.
     *
     * @var array
     */
    protected $passthroughExceptions = [
        'id',
        'title',
    ];

    /**
     * Returns true by default, but override if additional logic is required.
     *
     * @param \Illuminate\Database\Eloquent\Model $instance
     * @param mixed $datum
     */
    public function shouldSave( Model $instance, $datum )
    {
        return true;
    }

    /**
     * Fill in a model instance's fields from the given datum, typically from another system.
     * Pass `true` as the third argument to do a test run, without changing anything.
     *
     * @param \Illuminate\Database\Eloquent\Model $instance
     * @param mixed $datum
     * @param boolean $test
     */
    public function fill( Model $instance, $datum, $is_test = false )
    {

        // Transform $datum into instanceof Datum
        $datum = $this->getDatum( $datum );

        // Run through the field transformations
        $datum = $this->transform( $datum );

        // Remove any fields that aren't present in the model
        // $datum changes from Datum to array after this call
        $datum = $this->prune( $datum, $this->getAttributes( $instance ) );

        // Fill the instance with mapped source data
        $instance->fill( $datum );

        return $datum;

    }

    /**
     * Update a model instance's relations from the given datum, typically from another system.
     * Pass `true` as the third argument to do a test run, without changing anything.
     *
     * @param \Illuminate\Database\Eloquent\Model $instance
     * @param mixed $datum
     * @param boolean $test
     */
    public function sync( Model $instance, $datum, $is_test = false )
    {

        // Transform $datum into instanceof Datum
        $datum = $this->getDatum( $datum );

        // Defined in child transformers that extend this class
        $relations = $this->getSync( $datum );

        // Return what would be changed for debug
        if( $is_test )
        {
            return $relations;
        }

        // Run hard-wired attachments
        $this->syncEx( $instance, $datum );

        // Sync many-to-many relationships
        foreach( $relations as $relation => $ids )
        {
            $instance->$relation()->sync( $ids );
        }

        return $relations;

    }

    /**
     * Sometimes, the `id` with which we'll store a record here won't match the `id` that
     * has been provided by the source system. When checking if a record already exists,
     * we should use the `id` as it is after it has been transformed, not before.
     *
     * @TODO: Make `getIds` return only a single element?
     *
     * @param mixed $datum
     */
    public function getId( $datum )
    {
        $ids = $this->getIds($this->getDatum($datum));

        return reset($ids);
    }

    /**
     * Overwrite this method in child transformers. It should return an array, wherein the keys are
     * names of relation methods on the model, and the values are things that the model's `sync`
     * method would accept as its first argument.
     *
     * Note that calling this method should *not* change anything in the related model.
     *
     * @link https://laravel.com/docs/5.6/eloquent-relationships#updating-many-to-many-relationships
     *
     * @param  \App\Transformers\Datum  $datum
     * @return array
     */
    protected function getSync( Datum $datum )
    {

        return [];

    }

    /**
     * Sometimes, you just need to hard-code relation creation. Overwrite this
     * method in child classes when returning an array via `getSync` won't do.
     *
     * @param \Illuminate\Database\Eloquent\Model  $instance
     * @param \App\Transformers\Datum  $datum
     */
    protected function syncEx( Model $instance, Datum $datum )
    {
        return;
    }

    /**
     * Get identifiers from source data. Meant to be overwritten.
     *
     * @param  \App\Transformers\Datum  $datum
     * @return array
     */
    protected function getIds( Datum $datum )
    {

        return [
            'id' => $datum->id,
        ];

    }

    /**
     * Get title from source data. Meant to be overwritten.
     *
     * @param  \App\Transformers\Datum  $datum
     * @return array
     */
    protected function getTitle( Datum $datum )
    {

        return [
            'title' => $datum->title,
        ];

    }

    /**
     * Get dates from source data. Meant to be overwritten.
     *
     * @TODO Grab dates from the model's `getDates` method..?
     *
     * @param  \App\Transformers\Datum  $datum
     * @return array
     */
    protected function getDates( Datum $datum )
    {

        return [
            'source_created_at' => $datum->date('created_at'),
            'source_modified_at' =>$datum->date('modified_at'),
            'source_indexed_at' => $datum->date('indexed_at'),
        ];

    }

    /**
     * Method to allow child classes to define `fill` fields that are named differently from the API,
     * or should be treated differently. You can do all your mapping here.
     *
     * @param  \App\Transformers\Datum  $datum
     * @return array
     */
    protected function getExtraFields( Datum $datum )
    {

        return [];

    }

    /**
     * Helper to reduce repetition for importing "pivot" relations.
     *
     * @TODO Raise validation alert when encountering pivot w/o `pivot_field`?
     *
     * @param  \App\Transformers\Datum  $datum
     * @param  string  $pivot_field  Field on `$datum` whose value is an array that contains pivot objects
     * @param  string  $id_field     Each pivot object *must* have this field, if not, it'll be ignored
     * @param  string  $mapping_fn   Function to transform each pivot into ids for `sync`
     *
     * @return array
     */
    protected function getSyncPivots( Datum $datum, $pivot_field, $id_field, $mapping_fn )
    {

        // This method assumes that the pivot field's value is an array, not an object!
        // TODO: Improve error reporting in the latter case..?
        if( !$datum->$pivot_field || !is_array($datum->$pivot_field) )
        {
            return [];
        }

        $pivots = collect( $datum->$pivot_field )->filter( function( $pivot ) use ( $id_field ) {

            return (bool) ($pivot->$id_field ?? false);

        })->map( $mapping_fn );

        // Collapse the array while preserving numeric keys, i.e. CITI IDs
        $pivots = array_reduce($pivots->all(), function ($carry, $item) { return $carry + $item; }, []);

        return $pivots;

    }

    /**
     * Helper method to retrieve a datum – an object with some convenience methods.
     *
     * @param mixed $datum
     * @return \App\Transformers\Datum
     */
    private function getDatum( $datum )
    {

        if( $datum instanceof Datum )
        {
            return $datum;
        }

        return new Datum( $datum );

    }

    /**
     * Unlike `getSync`, this method isn't meant to be overwritten by child classes.
     *
     * @param \App\Transformers\Datum $datum
     * @return array
     */
    private function transform( Datum $datum )
    {

        // Use the stored datum as the base - we can prune it later!
        $base = $this->passthrough ? $datum->all() : [];

        // Remove any blacklisted fields
        $base = $this->prune( $base, $this->passthroughExceptions, true );

        return array_merge( $base,

            // For convenience, you can overwrite these methods, so that you don't
            // need to call `parent::getExtraFields` in child classes. But you can
            // put *all* custom field mapping in `getExtraFields`, if you'd like.
            $this->getIds( $datum ),
            $this->getTitle( $datum ),
            $this->getDates( $datum ),

            // Get all custom-mapped fields
            $this->getExtraFields( $datum )

        );

    }

    /**
     * Given an array of key-values and an array of strings, remove any keys from
     * the first which aren't present in the second.
     *
     * You can use this to remove any fields that aren't columns in the database.
     * Meant to be run as a penultimate step, right before filling the instance.
     *
     * @param array $datum
     * @param array $attributes
     * @param bool $isBlacklist
     * @return array
     */
    private function prune( array $datum, array $attributes, bool $isBlacklist = false )
    {

        return array_filter( $datum, function( $key ) use ( $attributes, $isBlacklist ) {
            $match = in_array( $key, $attributes );
            return $isBlacklist ? !$match : $match;
        }, ARRAY_FILTER_USE_KEY);

    }

    /**
     * Helper method to retrieve names of "fillable" attributes from the saved model.
     * Note that this is essentially a field listing – it doesn't include relations.
     *
     * @TODO Make this exclude guarded attributes?
     *
     * @param \Illuminate\Database\Eloquent\Model $instance
     * @return array
     */
    private function getAttributes( Model $instance )
    {

        $columns = Schema::getColumnListing( $instance->getTable() );

        // We generally don't want the source data polluting our timestamps
        $columns = array_diff( $columns, ['created_at', 'updated_at'] );

        // Fix any index-related bugs before they crop up
        // https://stackoverflow.com/a/6914929/1943591
        $columns = array_values( $columns );

        return $columns;

    }

}
