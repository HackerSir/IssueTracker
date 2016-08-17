<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMentionablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentionables', function (Blueprint $table) {
            $table->integer('comment_id')->unsigned();
            $table->string('mention_type');
            $table->integer('mention_id')->unsigned();

            $table->foreign('comment_id')->references('id')->on('comments')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['comment_id', 'mention_type', 'mention_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mentionables');
    }
}
