<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use IssueTracker\Label;

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
            $table->string('color')->default('grey');

            $table->foreign('color')->references('name')->on('colors')->onUpdate('cascade')->onDelete('cascade');
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

        // Create some sample label
        Label::create(['name' => 'Important', 'color' => 'red']);
        Label::create(['name' => 'Invalid', 'color' => 'grey']);
        Label::create(['name' => 'Help wanted', 'color' => 'green']);
        Label::create(['name' => 'Question', 'color' => 'pink']);
        Label::create(['name' => 'Task', 'color' => 'blue']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('issue_label');
        Schema::drop('labels');
    }
}
