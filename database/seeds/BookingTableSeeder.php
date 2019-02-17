<?php

use Illuminate\Database\Seeder;

class BookingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("booking")->insert([
            [
                "id" => 1,
                "created_at" => Carbon\Carbon::now(),
                "updated_at" => Carbon\Carbon::now(),
                "leader_id" => 1,
				"ship_id" => 1,
				"color" => "#fff",
				"arrival_date" => "2019-03-05",
				"departure_date" => "2019-04-05",
				"additional_info" => "some additional info",
				"group_name" => "some group name",
				"evening_program" => true
            ],
            [
                "id" => 2,
                "created_at" => Carbon\Carbon::now(),
                "updated_at" => Carbon\Carbon::now(),
                "leader_id" => 2,
				"ship_id" => 2,
				"color" => "#f8f8f8",
				"arrival_date" => "2019-04-05",
				"departure_date" => "2019-05-05",
				"additional_info" => "some additional info second",
				"group_name" => "some group name second",
				"evening_program" => false
            ],
		]);
    }
}
