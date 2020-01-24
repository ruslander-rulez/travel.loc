<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_message_attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->string("origin_filename");
            $table->string("filename");
            $table->string("mime-type");
            $table->string("storage");
            $table->unsignedInteger("chat_message_id")->index();
            $table->timestamps();

            $table
				->foreign("chat_message_id")
				->on(\App\Domain\ChatMessage\ChatMessage::ENTITY_TABLE)
				->references("id")
				->ondelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_message_attachments');
    }
}
