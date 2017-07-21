<?php

use Illuminate\Database\Seeder;

use App\Models\Collections\AgentType;
use App\Models\Collections\Agent;
use App\Models\Collections\Department;
use App\Models\Collections\Artwork;
use App\Models\Collections\Gallery;
use App\Models\Collections\Theme;
use App\Models\Collections\Link;
use App\Models\Collections\Video;
use App\Models\Collections\ObjectType;
use App\Models\Collections\Sound;
use App\Models\Collections\Text;
use App\Models\Collections\Image;
use App\Models\Collections\Category;
use App\Models\Collections\Exhibition;

class CollectionsDatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->clean();

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

    private function clean()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

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

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }

}