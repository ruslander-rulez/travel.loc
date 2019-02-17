<?php

use Illuminate\Database\Seeder;

class BackendUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("backend_user")->insert([
            [
                "id" => 1,
                "email" => "ruslansivets@gmail.com",
                "password" => bcrypt("52466664r"),
                "name" => "Ruslan Sivets",
                "reset_password_code" => null
            ],
            [
                "id" => 2,
                "email" => "ceo@itravelspb.com",
                "password" => bcrypt("996391725Anna"),
                "name" => "Extender`s Admin",
                "reset_password_code" => null
            ]
        ]);
    }
}
