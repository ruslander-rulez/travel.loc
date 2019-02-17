<?php

use Illuminate\Database\Seeder;

class ShipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("ship")->insert([
            [
                "id" => 1,
                "created_at" => Carbon\Carbon::now(),
                "updated_at" => Carbon\Carbon::now(),
                "name" => "Laguna",
            ],
            [
                "id" => 2,
                "created_at" => Carbon\Carbon::now(),
                "updated_at" => Carbon\Carbon::now(),
                "name" => "Titanic",
            ],
        ]);
    }
}
