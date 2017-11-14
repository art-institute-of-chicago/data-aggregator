<?php

use Illuminate\Database\Seeder;

abstract class AbstractSeeder extends Seeder
{

    // We don't make `seed` and `unseed` required via abstract methods.
    // This way the child class can overwrite the `run` or `clean` method.
    // This is useful if the child class just wants to use AbstractSeeder's helper methods.
    // `method_exists` is how Laravel's Seeder checks for `run`

    // abstract protected function seed();
    // abstract protected static function unseed();

    public function run()
    {

        if (! method_exists($this, 'seed')) {
            throw new InvalidArgumentException('Method [seed] missing from '.get_class($this));
        }

        \DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $this->seed();

        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }

    public static function clean()
    {

        if (! method_exists(self::class, 'unseed')) {
            throw new InvalidArgumentException('Method [unseed] missing from '.get_class(self));
        }

        \DB::statement('SET FOREIGN_KEY_CHECKS=0');

        self::unseed();

        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }


    /**
     * Helper method for seeding pivot tables. It will loop through all fake instances of the
     * `$parent` model, and attach 2-4 fake instances of the `$child` model via `$relation`,
     * which must be an instance of Laravel's `BelongsToMany`, such as that returned by a call
     * to `belongsToMany` in an e.g. `children()` method on the model.
     *
     * If `$parent` and `$child` refer to the same class, measures are taken to ensure that an
     * instance of a model is never attached to itself.
     *
     * @link https://laravel.com/docs/5.5/eloquent-relationships#many-to-many
     * @link https://stackoverflow.com/a/36189199/1943591
     *
     * @param  string  $parent  Class name of the "parent" model
     * @param  string  $child   Class name of the "child" model
     * @param  string  $method  Name of method on parent, which must return an instance of
     *                          \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    protected function seedBelongsToMany( $parent, $child, $method )
    {

        $isReflexive = ( $parent === $child );

        $childKey = ( new $child )->getKeyName();
        $childIds = $child::fake()->pluck( $childKey );

        $parents = $parent::fake()->get();

        foreach ($parents as $parent)
        {

            $ids = $childIds->random( rand(2,4) );

            if ($isReflexive)
            {
                $ids = $ids->diff( [ $parent->getKey() ] );
            }

            $parent->$method()->sync( $ids->all() );

        }

    }

}
