<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Ön Büro';
        $user->username = 'onburo';
        $user->email = 'onburo@example.com';
        $user->password = bcrypt('12121212');
        $user->save();

        $admin = new User();
        $admin->name = 'Proje Kullanıcısı';
        $admin->username = 'proje';
        $admin->email = 'proje@example.com';
        $admin->password = bcrypt('12121212');
        $admin->save();

        $author = new User();
        $author->name = 'Admin';
        $author->username = 'admin';
        $author->email = 'admin@example.com';
        $author->password = bcrypt('12121212');
        $author->save();
    }
}
