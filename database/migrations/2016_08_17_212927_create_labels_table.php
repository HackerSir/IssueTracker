<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for storing labels
        Schema::create('labels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->integer('color_id')->unsigned();

            $table->foreign('color_id')->references('id')->on('colors')->onUpdate('cascade')->onDelete('cascade');
        });

        // Create table for associating labels to issues (Many-to-Many)
        Schema::create('issue_label', function (Blueprint $table) {
            $table->integer('issue_id')->unsigned();
            $table->integer('label_id')->unsigned();
            $table->foreign('issue_id')->references('id')->on('issues')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('label_id')->references('id')->on('labels')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['issue_id', 'label_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('label_issue');
        Schema::drop('labels');
    }
}
