<?php

use Illuminate\Database\Seeder;

class BoardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $boards = [
            'Test Board 1',
            'Test Board 2',
        ];

        foreach ($boards as $name) {

            DB::table('boards')->insert([
                'name' => $name,
//                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
}
