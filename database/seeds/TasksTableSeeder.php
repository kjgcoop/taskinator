<?php

use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Boards
        DB::table('boards')->insert([
            'name' => 'Board',
        ]);



        // Lists
        DB::table('t_lists')->insert([
            'name' => 'List 1',
            'board_id' => 1,
            'sort' => 1,
        ]);


        // Tasks
        DB::table('tasks')->insert([
            'name' => 'Task 1 of list 1',
            't_list_id' => 1,
            'sort' => 1,
        ]);

        DB::table('tasks')->insert([
            'name' => 'Task 2 of list 1',
            't_list_id' => 1,
            'sort' => 2,
        ]);

        DB::table('tasks')->insert([
            'name' => 'Unaffiliated',
            't_list_id' => 0,
            'sort' => 1,
        ]);

        // Tags
        DB::table('tags')->insert([
            'name' => 'Tag 1',
            'color_id' => 3,
        ]);


        // Task-tag
        DB::table('tag_task')->insert([
            'tag_id' => 1,
            'task_id' => 1,
        ]);


    }
}
