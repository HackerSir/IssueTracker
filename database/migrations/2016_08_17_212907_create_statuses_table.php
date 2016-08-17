<?php

use IssueTracker\Status;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for storing statuses
        Schema::create('statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->integer('color_id')->unsigned();

            $table->foreign('color_id')->references('id')->on('colors')->onUpdate('cascade')->onDelete('cascade');
        });

        // Create statuses
        Status::create(['name' => 'Opened', 'color_id' => '1']);
        Status::create(['name' => 'Reopened', 'color_id' => '2']);
        Status::create(['name' => 'Closed', 'color_id' => '5']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('statuses');
    }
}
