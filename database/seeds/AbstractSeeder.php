<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Relations\Relation;

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

        if (!method_exists($this, 'seed')) {
            throw new InvalidArgumentException('Method [seed] missing from ' . get_class($this));
        }

        $this->seed();

    }

    public static function clean()
    {

        if (!method_exists(get_called_class(), 'unseed')) {
            throw new InvalidArgumentException('Method [unseed] missing from ' . get_called_class());
        }

        get_called_class()::unseed();

    }

    /**
     * Helper method for seeding relations. It attaches fake instances of the "object" model to
     * fake instances of the "subject" model, using the subject's specified method.
     *
     * The method must return an instance of \Illuminate\Database\Eloquent\Relations\Relation,
     * or rather one of the classes that extend it. The following are currently supported:
     *
     *  - \Illuminate\Database\Eloquent\Relations\BelongsToMany
     *  - \Illuminate\Database\Eloquent\Relations\HasMany
     *  - \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * If subject and object refer to the same class, measures are taken to ensure that an
     * instance of a model is never attached to itself.
     *
     * @param  string  $subjectClass  Class name of the "subject" model to which objects are attached
     * @param  string  $objectClass   Class name of the "object" model which gets attached to subject
     * @param  string  $method        Name of method on subject, which must return an instance of
     *                                \Illuminate\Database\Eloquent\Relations\Relation
     */
    protected function seedRelation($subjectClass, $objectClass, $method)
    {

        $isReflexive = ($subjectClass === $objectClass);

        $subjects = $subjectClass::fake()->get();
        $objects = $objectClass::fake()->get();

        $this->validateSeedRelation($subjectClass, $objectClass, $subjects, $objects, $method);

        $delegate = $this->getRelationMethod($subjectClass, $method);

        foreach ($subjects as $subject)
        {

            $selected = $objects->random(rand(2, 4));

            if ($isReflexive)
            {
                $selected = $selected->diff([$subject]);
            }

            $this->{$delegate}($subject, $selected, $method);

        }

    }

    /**
     * Determine which `seed___` method should be used for this relationship.
     */
    private function getRelationMethod($subjectClass, $method)
    {

        $relation = ( new $subjectClass() )->{$method}();
        $class = get_class($relation);

        $classname = explode('\\', $class);
        $classname = collect($classname);
        $classname = $classname->last();

        return 'seed' . $classname;

    }

    /**
     * Helper for seeding BelongsToMany relations.
     *
     * @link https://laravel.com/docs/5.5/eloquent-relationships#many-to-many
     */
    private function seedBelongsToMany($subject, $objects, $method)
    {

        $subject->{$method}()->sync($objects);

    }

    /**
     * Helper for seeding BelongsToManyOrOne relations.
     */
    private function seedBelongsToManyOrOne($subject, $objects, $method)
    {

        $subject->{$method}()->sync($objects);

    }

    /**
     * Helper for seeding HasMany relations.
     *
     * @link https://laravel.com/docs/5.5/eloquent-relationships#one-to-many
     */
    private function seedHasMany($subject, $objects, $method)
    {

        $subject->{$method}()->saveMany($objects);

    }

    /**
     * Helper for seeding BelongsTo relations.
     *
     * @link https://laravel.com/docs/5.5/eloquent-relationships#updating-belongs-to-relationships
     */
    private function seedBelongsTo($subject, $objects, $method)
    {

        $object = $objects->random();

        $subject->{$method}()->associate($object);

        $subject->save();

    }

    /**
     * Validates parameters and database state for running `seedRelation`.
     *
     * @param  string  $subjectClass  Class name of the "subject" model to which objects are attached
     * @param  string  $objectClass   Class name of the "object" model which gets attached to subject
     * @param  string  $subjects      Instances of $subjectClass
     * @param  string  $objects       Instances of $objectClass
     * @param  string  $method        Name of method on subject, which must return an instance of
     *                                \Illuminate\Database\Eloquent\Relations\Relation
     */
    private function validateSeedRelation($subjectClass, $objectClass, $subjects, $objects, $method)
    {

        if(!method_exists($subjectClass, $method))
        {
            throw new BadFunctionCallException('Class ' . $subjectClass . ' has no relation method `' . $method . '`');
        }

        $relation = ( new $subjectClass() )->{$method}();

        if(!$relation instanceof Relation)
        {
            throw new InvalidArgumentException($subjectClass . '\'s `' . $method . '` must return an instance of ' . Relation::class);
        }

        $prefix = 'Attempting to relate ' . $subjectClass . ' to ' . $objectClass;

        if($subjects->count() < 1)
        {
            throw new InvalidArgumentException($prefix . ', but there are no ' . $subjectClass . '\'s in the database.');
        }

        if($objects->count() < 1)
        {
            throw new InvalidArgumentException($prefix . ', but there are no ' . $objectClass . '\'s in the database.');
        }

    }

}
