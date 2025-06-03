<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate([
            "email" => "admin@admin.com"
        ],[
            "name" => "Admin",
            "email" => "admin@admin.com",
            "password" => Hash::make("password")
        ]);
    }
}
