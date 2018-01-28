<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//
//        DB::table("users")->insert(array(
//            'identification' => 1118562589,
//            'name' => 'Jorge Eduardo',
//            'last_name' => 'Hernandez Oropeza',
//            'username' => 'joredher',
//            'email' => 'joredher30@gmail.com',
//            'password' => Hash::make('admin@teachar'),
//            'state' => '1',
//        ));
//
//        DB::table("users")->insert(array(
//            'identification' => 1102369241,
//            'name' => 'Edisson Fernando',
//            'last_name' => 'Quiñonez Diaz',
//            'username' => 'kynebu',
//            'email' => 'kynebu@hotmail.com',
//            'password' => Hash::make('admin@teachar'),
//            'state' => '1',
//        ));
//
//        DB::table("users")->insert(array(
//            'identification' => 47435472,
//            'name' => 'Elibeth',
//            'last_name' => 'Oropeza',
//            'username' => 'elyoro',
//            'email' => 'elyoro08@hotmail.com',
//            'password' => Hash::make('docente123'),
//            'state' => '1',
//        ));


        $role_admin = Role::where('name','admin')->first();
        $role_profe = Role::where('name','profe')->first();

        $admin = new User();
        $admin->identification = 1118562589;
        $admin->name = 'Jorge Eduardo';
        $admin->last_name = 'Hernandez Oropeza';
        $admin->username = 'joredher';
        $admin->email = 'joredher30@gmail.com';
        $admin->password = Hash::make('admin@teachar');
        $admin->state = 'Activo';
        $admin->save();
        $admin->roles()->attach($role_admin);

        $admin2 = new User();
        $admin2->identification = 1102369241;
        $admin2->name = 'Edisson Fernando';
        $admin2->last_name = 'Quiñonez Diaz';
        $admin2->username = 'kynebu';
        $admin2->email = 'kynebu@hotmail.com';
        $admin2->password = Hash::make('admin@teachar');
        $admin2->state = 'Activo';
        $admin2->save();
        $admin2->roles()->attach($role_admin);

        $profe = new User();
        $profe->identification = 47435472;
        $profe->name = 'Elibeth';
        $profe->last_name = 'Oropeza';
        $profe->username = 'elyoro';
        $profe->email = 'elyoro08@hotmail.com';
        $profe->password = Hash::make('docente123');
        $profe->state = 'Activo';
        $profe->save();
        $profe->roles()->attach($role_profe);




    }
}
