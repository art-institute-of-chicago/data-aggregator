<?php

use Illuminate\Database\Seeder;

use App\Models\Collections\AgentType;
use App\Models\Collections\Agent;
use App\Models\Collections\Department;
use App\Models\Collections\ObjectType;
use App\Models\Collections\Category;
use App\Models\Collections\Gallery;
use App\Models\Collections\Artwork;
use App\Models\Collections\ArtworkCommittee;
use App\Models\Collections\ArtworkTerm;
use App\Models\Collections\ArtworkDate;
use App\Models\Collections\ArtworkCatalogue;
use App\Models\Collections\Theme;
use App\Models\Collections\Link;
use App\Models\Collections\Sound;
use App\Models\Collections\Video;
use App\Models\Collections\Text;
use App\Models\Collections\Image;
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

    public static function clean()
    {

        Exhibition::fake()->delete();
        Image::fake()->delete();
        Text::fake()->delete();
        Video::fake()->delete();
        Sound::fake()->delete();
        Link::fake()->delete();
        Theme::fake()->delete();
        ArtworkCatalogue::fake()->delete();
        ArtworkDate::fake()->delete();
        ArtworkTerm::fake()->delete();
        ArtworkCommittee::fake()->delete();
        Artwork::fake()->delete();
        Gallery::fake()->delete();
        Category::fake()->delete();
        ObjectType::fake()->delete();
        Department::fake()->delete();
        Agent::fake()->delete();
        AgentType::fake()->delete();

    }

}