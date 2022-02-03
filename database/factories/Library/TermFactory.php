<?php

namespace Database\Factories\Library;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Library\Term;

class TermFactory extends Factory
{
    protected $model = Term::class;

    public function definition()
    {
        $id = 'zz' . $this->faker->unique()->randomNumber(8);
        return [
            'id' => $id,
            'uri' => 'http://fake.loc.fake/authorities/fake/' . $id,
            'title' => ucfirst($this->faker->words(3, true)),
        ];
    }
}
