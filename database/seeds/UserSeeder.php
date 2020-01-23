<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 3,
                'username' => 'dev',
                'name' => 'Developer',
                'email' => 'laurentiuskevin44@gmail.com',
                'password' => \Illuminate\Support\Facades\Crypt::encryptString('dev')
            ]
        ];

        foreach ($data as $d) {
            $user = new \App\User();
            $user->id = $d['id'];
            $user->username = $d['username'];
            $user->name = $d['name'];
            $user->email = $d['email'];
            $user->password = $d['password'];
            $user->save();
        }
    }
}
