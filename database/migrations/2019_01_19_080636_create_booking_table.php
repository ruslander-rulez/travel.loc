<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("ship_id")->index();
            $table->unsignedInteger("leader_id")->index()->nullable();
            $table->string("group_name")->nullable();
            $table->string("color");
            $table->text("additional_info")->nullable();
            $table->boolean("evening_program")->default(0);
			$table->date("arrival_date");
			$table->date("departure_date");
			$table->timestamps();
            $table->softDeletes();

            $table->foreign("ship_id")
				->references('id')
				->on('ship')
				->onDelete("cascade");

            $table->foreign("leader_id")
				->references('id')
				->on('clients')
				->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking');
    }
}
