<?php

use Illuminate\Database\Seeder;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            'ffffff' => 'White',
            'ff0000' => 'Red',
            'ff7f00' => 'Orange',
            'ffff00' => 'Yellow',
            '3b662f' => 'Green',
            '0000ff' => 'Blue',
            '9000ff' => 'Purple',
            '666666' => 'Grey',
            '000000' => 'Black',
        ];

        foreach ($colors as $hex => $name) {

            DB::table('colors')->insert([
                'name' => $name,
                'hex' => $hex,
//                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
}
