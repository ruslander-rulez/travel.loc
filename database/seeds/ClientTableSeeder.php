<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("clients")->insert([
            [
                "id" => 1,
                "created_at" => Carbon\Carbon::now(),
                "updated_at" => Carbon\Carbon::now(),
                "name" => "James Bond",
                "passport" => "123DD121",
				"nationality" => "USA",
				"birthday" => "1886-12-11",
				"phone" => "778656654",
				"email" => "bond@test.test"
            ],
            [
                "id" => 2,
                "created_at" => Carbon\Carbon::now(),
                "updated_at" => Carbon\Carbon::now(),
                "name" => "Jon Smith",
                "passport" => "qq12121",
				"nationality" => "Canada",
				"birthday" => "1886-01-05",
				"phone" => "7786123",
				"email" => "jon@test.test"
            ],

        ]);
    }
}
