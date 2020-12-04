<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

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
        $user->name = "Jonathan";
        $user->last_name = "Soto";
        $user->email = "jsoto@uabcs.mx";
        $user->password = bcrypt("secret");
        $user->rol = 'ADMIN';
        $user->save();

        $user = new User();
        $user->name = "Pedro";
        $user->last_name = "Paramo";
        $user->email = "pedro@correo.mx";
        $user->password = bcrypt("123456");
        $user->save();
    }
}
