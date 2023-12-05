<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Supprimer les données qui existent déja dans la table  avant de la peupler
        Role::truncate();

        //Création des utilisateurs et des rôles
        Role::create(["name"=> "admin"]);
        Role::create(["name"=> "agent"]);
    }
}
