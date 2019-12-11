<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("profile_id")->index();
            $table->unsignedInteger("admin_id")->index();
            $table->boolean("is_read");
            $table->string("type");
            $table->text("message");
            $table->timestamps();

            $table
				->foreign("profile_id")
				->on(App\Domain\Profile\Profile::ENTITY_TABLE)
				->references("id")
				->onDelete("cascade");
            $table
				->foreign("admin_id")
				->on(App\Domain\BackendUser\BackendUser::ENTITY_TABLE)
				->references("id")
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
        Schema::dropIfExists('chat_messages');
    }
}
