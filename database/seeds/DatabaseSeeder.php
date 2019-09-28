<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BoardsTableSeeder::class);
        $this->call(ColorsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TasksTableSeeder::class);
    }
}
