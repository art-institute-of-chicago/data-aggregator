<?php

use App\Models\Collections\AgentType;
use App\Models\Collections\Agent;
use App\Models\Collections\Department;
use App\Models\Collections\ObjectType;
use App\Models\Collections\Category;
use App\Models\Collections\Place;
use App\Models\Collections\Artwork;
use App\Models\Collections\ArtworkCommittee;
use App\Models\Collections\ArtworkTerm;
use App\Models\Collections\ArtworkDate;
use App\Models\Collections\ArtworkCatalogue;
use App\Models\Collections\Theme;
use App\Models\Collections\Asset;
use App\Models\Collections\Exhibition;

class CollectionsDatabaseSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $this->call(AgentTypesTableSeeder::class);
        $this->call(AgentsTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
        $this->call(ObjectTypesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(PlacesTableSeeder::class);
        $this->call(PlaceCategoriesTableSeeder::class);
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
        $this->call(AssetsTableSeeder::class);
        $this->call(AssetCategoriesTableSeeder::class);
        $this->call(ExhibitionsTableSeeder::class);

    }

    protected static function unseed()
    {

        Exhibition::fake()->delete();
        Asset::fake()->delete();
        Theme::fake()->delete();
        ArtworkCatalogue::fake()->delete();
        ArtworkDate::fake()->delete();
        ArtworkTerm::fake()->delete();
        ArtworkCommittee::fake()->delete();
        Artwork::fake()->delete();
        Place::fake()->delete();
        Category::fake()->delete();
        ObjectType::fake()->delete();
        Department::fake()->delete();
        Agent::fake()->delete();
        AgentType::fake()->delete();

    }

}
