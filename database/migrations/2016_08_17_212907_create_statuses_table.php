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
            $table->string('color')->default('grey');

            $table->foreign('color')->references('name')->on('colors')->onUpdate('cascade')->onDelete('cascade');
        });

        // Create statuses
        Status::create(['name' => 'Opened', 'color' => 'red']);
        Status::create(['name' => 'Reopened', 'color_id' => 'orange']);
        Status::create(['name' => 'Closed', 'color_id' => 'green']);
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
