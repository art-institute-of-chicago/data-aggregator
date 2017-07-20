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
        factory(App\Models\Dsc\Figure::class, 300)->create();

        $this->_addToFigures();

    }

    private function _addToFigures()
    {

        $faker = Faker\Factory::create();

        $figures = App\Models\Dsc\Figure::all()->all();

        foreach ($figures as $figure) {

            for ($i = 0; $i < rand(2,8); $i++) {

                $attach = factory(App\Models\Dsc\FigureImage::class)->create(['figure_dsc_id' => $figure->dsc_id]);

                $figure->images()->save($attach);

            }

            for ($i = 0; $i < rand(2,8); $i++) {

                $attach = factory(App\Models\Dsc\FigureVector::class)->create(['figure_dsc_id' => $figure->dsc_id]);

                $figure->vectors()->save($attach);

            }

        }

    }

}
