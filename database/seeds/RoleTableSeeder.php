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

        $role = new Role();
        $role->name ='admin';
        $role->description = 'Administrator';
        $role->save();

        $role = new Role();
        $role->name = 'profe';
        $role->description = 'Usuario';
        $role->save();


//        DB::table("roles")->insert(array(
//            'name' => 'admin',
//            'description' => 'Manejo total del sistema.'
//        ));
//
//        DB::table("roles")->insert(array(
//            'name' => 'profe',
//            'description' => 'Manejo Interfaz.'
//        ));

//        DB::table("role_user")->insert(array(
//           'role_id' => 1,
//            'user_id' => 1
//        ));
//
//        DB::table("role_user")->insert(array(
//        'role_id' => 1,
//        'user_id' => 2
//        ));
//
//        DB::table("role_user")->insert(array(
//            'role_id' => 2,
//            'user_id' => 3
//        ));

//
//        $role_profe = new Role();
//        $role_profe->name = 'profe';
//        $role_profe->description = 'Visualización e Interactividad.';
//        $role_profe->save();
//
//        $role_admin = new Role();
//        $role_admin->name = 'admin';
//        $role_admin->description = 'Control Total.';
//        $role_admin->save();
    }
}
