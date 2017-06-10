<?php

use Illuminate\Database\Seeder;

use App\Collections\Artist;
use App\Collections\Department;
use App\Collections\Artwork;
use App\Collections\Gallery;
use App\Collections\Theme;
use App\Collections\Video;
use App\Collections\Sound;
use App\Collections\Text;
use App\Collections\Image;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->_cleanDatabase();
        
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

    private function _cleanDatabase() {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Category::truncate();
        Image::truncate();
        Text::truncate();
        Sound::truncate();
        Video::truncate();
        Theme::truncate();
        Gallery::truncate();
        Artwork::truncate();
        
        Department::truncate();
        Artist::truncate();
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
