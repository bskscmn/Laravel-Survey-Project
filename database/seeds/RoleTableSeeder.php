<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = new Role();
        $role_admin->name = 'Admin';
        $role_admin->description = 'Yönetici';
        $role_admin->save();

        $role_proje = new Role();
        $role_proje->name = 'Proje';
        $role_proje->description = 'Proje Ekranı';
        $role_proje->save();

        $role_onburo = new Role();
        $role_onburo->name = 'Ön Büro';
        $role_onburo->description = 'Ön büro ekranı';
        $role_onburo->save();
    }
}
