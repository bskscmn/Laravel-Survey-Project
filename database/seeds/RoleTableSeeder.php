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
        $role_admin->description = 'Administrator';
        $role_admin->save();

        $role_proje = new Role();
        $role_proje->name = 'Show';
        $role_proje->description = 'Show Analytics';
        $role_proje->save();

        $role_onburo = new Role();
        $role_onburo->name = 'Survey';
        $role_onburo->description = 'Show Survey';
        $role_onburo->save();
    }
}
