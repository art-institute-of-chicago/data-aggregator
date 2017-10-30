<?php

use Illuminate\Database\Seeder;

class FiguresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Dsc\Figure::class, 50)->create();

        $this->_addToFigures();

    }

    private function _addToFigures()
    {

        $faker = Faker\Factory::create();

        $figures = App\Models\Dsc\Figure::fake()->get();

        foreach ($figures as $figure) {

            for ($i = 0; $i < rand(2,4); $i++) {

                $attach = factory(App\Models\Dsc\FigureImage::class)->create(['figure_dsc_id' => $figure->dsc_id]);

                $figure->images()->save($attach);

            }

            for ($i = 0; $i < rand(2,4); $i++) {

                $attach = factory(App\Models\Dsc\FigureVector::class)->create(['figure_dsc_id' => $figure->dsc_id]);

                $figure->vectors()->save($attach);

            }

        }

    }

}
