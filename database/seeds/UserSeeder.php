<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@123.com',
            'password' => Hash::make('!Qaz2wsx'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'teacher',
            'email' => 'teacher@123.com',
            'password' => Hash::make('!Qaz2wsx'),
            'role' => 'teacher',
        ]);

        for ($i=0; $i <5 ; $i++) {
            User::create([
                'name' => 'test' . $i,
                'email' => "test$i@123.com",
                'password' => Hash::make('!Qaz2wsx'),
                'role' => 'user',
            ]);
        }
    }
}
