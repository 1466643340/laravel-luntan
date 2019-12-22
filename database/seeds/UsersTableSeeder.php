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
        $insertUsersData=[
            'id' => 1,
             'username' => \Str::random(10),
             'password' => bcrypt('password'),
             'ip' => '127.0.0.1',
            'avatar' => '/avatar/1.jpg'
        ];
        \DB::table('users')->insert($insertUsersData);
    }
}
