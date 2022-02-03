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
            [
                'name' => 'USER_REGISTRATION',
                'value' => 1,
            ],
            [
                'name' => 'MAIL_DRIVER',
                'value' => 'smtp',
            ],
            [
                'name' => 'MAIL_HOST',
                'value' => 'host',
            ],
            [
                'name' => 'MAIL_PORT',
                'value' => 'port',
            ],
            [
                'name' => 'MAIL_USERNAME',
                'value' => 'port',
            ],
            [
                'name' => 'MAIL_PASSWORD',
                'value' => 'password',
            ],
            [
                'name' => 'MAIL_ENCRYPTION',
                'value' => 'tls',
            ],
            [
                'name' => 'MAIL_FROM_ADDRESS',
                'value' => 'admin@example.com',
            ],
        ]);
    }
}
