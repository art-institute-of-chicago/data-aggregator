<?php

use Illuminate\Database\Seeder;

use App\Collections\AgentType;
use App\Collections\Agent;
use App\Collections\Department;
use App\Collections\Artwork;
use App\Collections\Gallery;
use App\Collections\Theme;
use App\Collections\Link;
use App\Collections\Video;
use App\Collections\ObjectType;
use App\Collections\Sound;
use App\Collections\Text;
use App\Collections\Image;
use App\Collections\Category;
use App\Collections\Exhibition;

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
        
        $this->call(AgentTypesTableSeeder::class);
        $this->call(AgentsTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
        $this->call(ObjectTypesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(GalleriesTableSeeder::class);
        $this->call(GalleryCategoriesTableSeeder::class);
        $this->call(ArtworksTableSeeder::class);
        $this->call(ArtistArtworksTableSeeder::class);
        $this->call(ArtworkCopyrightRepresentativesTableSeeder::class);
        $this->call(ArtworkCategoriesTableSeeder::class);
        $this->call(ArtworkCommitteesTableSeeder::class);
        $this->call(ArtworkTermsTableSeeder::class);
        $this->call(ArtworkDatesTableSeeder::class);
        $this->call(ArtworkCataloguesTableSeeder::class);
        $this->call(ArtworkArtworksTableSeeder::class);
        $this->call(ThemesTableSeeder::class);
        $this->call(LinksTableSeeder::class);
        $this->call(LinkCategoriesTableSeeder::class);
        $this->call(SoundsTableSeeder::class);
        $this->call(SoundCategoriesTableSeeder::class);
        $this->call(VideosTableSeeder::class);
        $this->call(VideoCategoriesTableSeeder::class);
        $this->call(TextsTableSeeder::class);
        $this->call(TextCategoriesTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
        $this->call(ImageCategoriesTableSeeder::class);
        $this->call(ExhibitionsTableSeeder::class);

    }

    private function _cleanDatabase() {

        DB::connection('mysql_for_citilake_data')->statement('SET FOREIGN_KEY_CHECKS=0');

        Exhibition::truncate();
        Image::truncate();
        Text::truncate();
        Video::truncate();
        Sound::truncate();
        Link::truncate();
        Theme::truncate();
        Artwork::truncate();
        Gallery::truncate();
        Category::truncate();        
        ObjectType::truncate();        
        Department::truncate();
        Agent::truncate();
        AgentType::truncate();
        
        DB::connection('mysql_for_citilake_data')->statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
