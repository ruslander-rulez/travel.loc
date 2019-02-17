<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BackendUserTableSeeder::class);
        $this->call(ShipTableSeeder::class);
        $this->call(ClientTableSeeder::class);
        $this->call(BookingTableSeeder::class);

    }
}

//$this->call(AttachmentTableSeeder::class);