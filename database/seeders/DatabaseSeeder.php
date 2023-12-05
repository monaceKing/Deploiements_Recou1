<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Liaison entre les tables Roles et Users: toujours appeler la table des rôles avant les utilisateurs
        $this->call(RolesTablesSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
