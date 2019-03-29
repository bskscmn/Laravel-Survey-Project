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
        $role_admin = Role::where('name', 'Admin')->first();
        $role_analytics = Role::where('name', 'Analytics')->first();

        $author = new User();
        $author->name = 'Admin';
        $author->username = 'admin';
        $author->email = 'admin@example.com';
        $author->password = bcrypt('111111');
        $author->save();
        $author->roles()->attach($role_admin);
        $author->roles()->attach($role_analytics);

        $analytics = new User();
        $analytics->name = 'Proje Kullanıcısı';
        $analytics->username = 'proje';
        $analytics->email = 'proje@example.com';
        $analytics->password = bcrypt('111111');
        $analytics->save();
        $analytics->roles()->attach($role_analytics);

    }
}
