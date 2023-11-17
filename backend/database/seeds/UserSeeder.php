<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = ['Admin', 'admin@localhost.com', bcrypt('123456')];
        DB::insert('insert into users (name, email, password) values (?, ?, ?)', $user);
    }
}
