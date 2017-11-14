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
     * Helper method for seeding BelongsToMany relations. It loops through all fake instances of the
     * `$subject` model, and attaches 2-4 fake instances of the `$object` model using the subject's
     * `$method`, which must return an instance of `BelongsToMany`.
     *
     * If `$subject` and `$object` refer to the same class, measures are taken to ensure that an
     * instance of a model is never attached to itself.
     *
     * @link https://laravel.com/docs/5.5/eloquent-relationships#many-to-many
     *
     * @param  string  $parent  Class name of the "subject" model to which objects are attached
     * @param  string  $child   Class name of the "object" model which gets attached to subject
     * @param  string  $method  Name of method on parent, which must return an instance of
     *                          \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    protected function seedBelongsToMany( $subjectClass, $objectClass, $method )
    {

        $isReflexive = ( $subjectClass === $objectClass );

        $subjects = $subjectClass::fake()->get();
        $objects = $objectClass::fake()->get();

        foreach ($subjects as $subject)
        {

            $selected = $objects->random( rand(2,4) );

            if ($isReflexive)
            {
                $selected = $selected->diff( [ $subject ] );
            }

            $subject->$method()->sync( $selected );

        }

    }


    /**
     * Helper method for seeding HasMany relationships. It loops through all fake instances of the
     * `$subject` model, and attaches 2-4 fake instances of the `$object` model using the subject's
     * `$method`, which must return an instance of `HasMany`.
     *
     * If `$subject` and `$object` refer to the same class, measures are taken to ensure that an
     * instance of a model is never attached to itself.
     *
     * @link https://laravel.com/docs/5.5/eloquent-relationships#one-to-many
     *
     * @param  string  $parent  Class name of the "subject" model to which objects are attached
     * @param  string  $child   Class name of the "object" model which gets attached to subject
     * @param  string  $method  Name of method on parent, which must return an instance of
     *                          \Illuminate\Database\Eloquent\Relations\HasMany
     */
    protected function seedHasMany( $subjectClass, $objectClass, $method )
    {

        $isReflexive = ( $subjectClass === $objectClass );

        $subjects = $subjectClass::fake()->get();
        $objects = $objectClass::fake()->get();

        foreach ($subjects as $subject)
        {

            $selected = $objects->random( rand(2,4) );

            if ($isReflexive)
            {
                $selected = $selected->diff( [ $subject ] );
            }

            $subject->$method()->saveMany( $selected );

        }

    }

}
