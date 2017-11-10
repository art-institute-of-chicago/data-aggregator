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

        $this->call(CollectionsDatabaseSeeder::class);
        $this->call(ShopDatabaseSeeder::class);
        $this->call(MembershipDatabaseSeeder::class);
        $this->call(MobileDatabaseSeeder::class);
        $this->call(DscDatabaseSeeder::class);
        $this->call(StaticArchiveDatabaseSeeder::class);

    }

    public static function clean()
    {

        CollectionsDatabaseSeeder::clean();
        ShopDatabaseSeeder::clean();
        MembershipDatabaseSeeder::clean();
        MobileDatabaseSeeder::clean();
        DscDatabaseSeeder::clean();
        StaticArchiveDatabaseSeeder::clean();

    }

}
