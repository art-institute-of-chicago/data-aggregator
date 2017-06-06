<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Models referenced in the Artwork seeder
        $this->call(ArtistsTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);

        $this->call(ArtworksTableSeeder::class);
        $this->call(GalleriesTableSeeder::class);
        $this->call(ThemesTableSeeder::class);
        $this->call(VideosTableSeeder::class);
        $this->call(SoundsTableSeeder::class);
        $this->call(TextsTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
    }
}
