<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for storing issues
        Schema::create('issues', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('status_id')->unsigned();
            $table->timestamps();

            $table->foreign('status_id')->references('id')->on('statuses')->onUpdate('cascade')->onDelete('cascade');
        });

        // Create table for associating issues to users (Many-to-Many)
        Schema::create('issue_user', function (Blueprint $table) {
            $table->integer('issue_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('issue_id')->references('id')->on('issues')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['issue_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('issue_user');
        Schema::drop('issues');
    }
}
