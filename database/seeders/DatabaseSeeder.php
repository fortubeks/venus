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
        $this->call([UsersTableSeeder::class]);
        $this->call([CountrySeeder::class]);
        $this->call([StateSeeder::class]);
        $this->call([HotelsTableSeeder::class]);
        $this->call([ExpenseCategorySeeder::class]);
        $this->call([DepartmentSeeder::class]);
    }
}
