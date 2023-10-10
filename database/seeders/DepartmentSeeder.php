<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            'id' => 1,
            'hotel_id' => 0,
            'name' => 'Default',
            'parent_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'id' => 2,
            'hotel_id' => 0,
            'name' => 'Food & Beverage',
            'parent_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'id' => 3,
            'hotel_id' => 0,
            'name' => 'Maintenance',
            'parent_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'id' => 4,
            'hotel_id' => 0,
            'name' => 'Housekeeping & Cleaning',
            'parent_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'id' => 5,
            'hotel_id' => 0,
            'name' => 'Laundry',
            'parent_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'id' => 6,
            'hotel_id' => 0,
            'name' => 'Store',
            'parent_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'id' => 7,
            'hotel_id' => 0,
            'name' => 'Gym',
            'parent_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'id' => 8,
            'hotel_id' => 0,
            'name' => 'Spa',
            'parent_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'id' => 9,
            'hotel_id' => 0,
            'name' => 'Kitchen',
            'parent_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'id' => 10,
            'hotel_id' => 0,
            'name' => 'Security',
            'parent_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'id' => 11,
            'hotel_id' => 0,
            'name' => 'Administrative',
            'parent_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
