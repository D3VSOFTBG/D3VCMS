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
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'D3VSOFT',
            'email' => 'admin@d3vsoft.com',
            'password' => '$2y$10$WEf3oHnfdXCjHFZ3yVFvlO7BiohpAtyTqH2wQpbIfeOYCee0lZ6Rq',
            'role' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
