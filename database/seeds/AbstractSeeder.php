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

}
