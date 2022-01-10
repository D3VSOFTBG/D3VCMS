<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'name' => 'TITLE',
                'value' => 'D3VCMS',
            ],
            [
                'name' => 'TITLE_SEPERATOR',
                'value' => '-',
            ],
            [
                'name' => 'FAVICON',
                'value' => NULL,
            ],
            [
                'name' => 'LOGO',
                'value' => NULL,
            ],
            [
                'name' => 'PAGINATION_ADMIN',
                'value' => '20',
            ],
        ]);
    }
}
