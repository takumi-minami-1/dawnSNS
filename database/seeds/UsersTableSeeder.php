<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'テスト3',
            'mail' => 'test3@icloud.com',
            'password' => 'test',
            'bio' => 'テスト3の自己紹介',
            'images' => 'dawn.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
