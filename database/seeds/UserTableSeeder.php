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
        // Can't put it straight into the table because it hashes the password.
        $data = [
            'name' => 'KJ';
            'email' => 'laravel@kjcoop.com';
            'password' => 'password';
        ]

        RegisterController::register($request);
    }
}
