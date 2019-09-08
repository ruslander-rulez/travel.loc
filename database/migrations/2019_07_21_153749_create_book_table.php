<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book', function (Blueprint $table) {
            $table->increments('id');
            $table->date("date_of_start");
            $table->date("date_of_end")->nullable();
            $table->string("group_name")->nullable();
            $table->string("leader_name")->nullable();
            $table->text("total_tourists")->nullable();
            $table->string("driver")->nullable();
            $table->string("guide")->nullable();
            $table->text("notes")->nullable();
            $table->json("program");
            $table->nullableMorphs("type");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book');
    }
}
