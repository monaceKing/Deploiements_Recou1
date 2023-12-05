<?php

namespace Database\Seeders;

use App\Models\Portefeuille;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Vider la table User avant de la peupler
        User::truncate();

        DB::table("role_user")->truncate();
        DB::table("portefeuille_user")->truncate();

        //création des utilisateurs
        $admin = User::create([
            //L'admin
            "name"=> "admin",
            "email"=> "monace@gmail.com",
            "password"=> bcrypt("KingMomo"),
        ]);

        $agent = User::create([
            //Agent simple
            "name"=> "agent",
            "email"=> "root@gmail.com",
            "password"=> bcrypt("LeRoot"),
        ]);

        $adminRole = Role::where("name","admin")->first();
        $agentRole = Role::where("name","agent")->first();
        
        //Ratachement entre l'utilisateur et son rôle en utilisant la fonction 'Roles' contenue dans le model 'User'
        $admin->roles()->attach($adminRole);
        $agent->roles()->attach($agentRole);

        //après avoir tout configurer et lier: executer la commande 'php artisan db:seed'
    }
}
