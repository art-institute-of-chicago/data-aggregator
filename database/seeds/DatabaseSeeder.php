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
