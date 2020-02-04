<?php

use App\Models\Collections\AgentType;
use App\Models\Collections\AgentRole;
use App\Models\Collections\Agent;
use App\Models\Collections\Category;
use App\Models\Collections\Place;
use App\Models\Collections\Gallery;
use App\Models\Collections\Artwork;
use App\Models\Collections\ArtworkType;
use App\Models\Collections\ArtworkTerm;
use App\Models\Collections\ArtworkDate;
use App\Models\Collections\ArtworkDateQualifier;
use App\Models\Collections\ArtworkCatalogue;
use App\Models\Collections\ArtworkPlaceQualifier;
use App\Models\Collections\Asset;
use App\Models\Collections\Exhibition;

class CollectionsDatabaseSeeder extends AbstractSeeder
{

    protected function seed()
    {
        $this->call(AgentTypesTableSeeder::class);
        $this->call(AgentRolesTableSeeder::class);
        $this->call(AgentsTableSeeder::class);
        $this->call(ArtworkTypesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(PlacesTableSeeder::class);
        $this->call(GalleriesTableSeeder::class);
        $this->call(PlaceCategoriesTableSeeder::class);
        $this->call(ArtworksTableSeeder::class);
        $this->call(ArtistArtworksTableSeeder::class);
        $this->call(ArtworkCategoriesTableSeeder::class);
        $this->call(ArtworkTermsTableSeeder::class);
        $this->call(ArtworkDateQualifiersTableSeeder::class);
        $this->call(ArtworkDatesTableSeeder::class);
        $this->call(ArtworkCataloguesTableSeeder::class);
        $this->call(ArtworkPlaceQualifierTableSeeder::class);
        $this->call(AssetsTableSeeder::class);
        $this->call(AssetCategoriesTableSeeder::class);
        $this->call(ExhibitionsTableSeeder::class);
    }

    protected static function unseed()
    {
        Exhibition::query()->delete();
        Asset::query()->delete();
        ArtworkCatalogue::query()->delete();
        ArtworkDate::query()->delete();
        ArtworkDateQualifier::query()->delete();
        ArtworkTerm::query()->delete();
        Artwork::query()->delete();
        Place::query()->delete();
        Gallery::query()->delete();
        Category::query()->delete();
        ArtworkType::query()->delete();
        ArtworkPlaceQualifier::query()->delete();
        Agent::query()->delete();
        AgentType::query()->delete();
        AgentRole::query()->delete();
    }

}
