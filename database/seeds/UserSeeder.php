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
        User::truncate();

        $user = new User;
        $user->name = 'tong';
        $user->email = 'a@a.com';
        $user->password = bcrypt('password');

        $user->save();
    }
}
