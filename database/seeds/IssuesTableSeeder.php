<?php

use Illuminate\Database\Seeder;

class IssuesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\IssueTracker\Issue::class, 20)->create();
    }
}
