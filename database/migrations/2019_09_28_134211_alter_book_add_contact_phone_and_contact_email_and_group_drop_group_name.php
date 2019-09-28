<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterBookAddContactPhoneAndContactEmailAndGroupDropGroupName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


    	\Illuminate\Support\Facades\DB::beginTransaction();
        Schema::table('book', function (Blueprint $table) {
            $table->string("contact_phone")->nullable();
            $table->string("contact_email")->nullable();

            $table->json("group")->nullable();
        });
		DB::update("UPDATE `book` set `group` = JSON_OBJECT('name', `book`.`group_name`)");

		Schema::table('book', function (Blueprint $table) {
			$table->dropColumn("group_name");
		});

		\Illuminate\Support\Facades\DB::commit();
	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('book', function (Blueprint $table) {
            $table->string("group_name");
            $table->dropColumn(["contact_phone", "contact_email", "group"]);
        });
    }
}
