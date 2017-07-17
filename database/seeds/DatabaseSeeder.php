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

        $this->call(CollectionsDatabaseSeeder::class);
        $this->call(ShopDatabaseSeeder::class);
        $this->call(MembershipDatabaseSeeder::class);
        $this->call(MobileDatabaseSeeder::class);
        $this->call(DscDatabaseSeeder::class);
        $this->call(StaticArchiveDatabaseSeeder::class);

    }

}
