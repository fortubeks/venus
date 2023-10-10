<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('expense_categories')->insert([
            'id' => 1,
            'hotel_id' => 0,
            'name' => 'Default',
            'parent_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('expense_categories')->insert([
            'id' => 2,
            'hotel_id' => 0,
            'name' => 'Food & Beverage',
            'parent_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('expense_categories')->insert([
            'id' => 3,
            'hotel_id' => 0,
            'name' => 'Maintenance',
            'parent_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('expense_categories')->insert([
            'id' => 4,
            'hotel_id' => 0,
            'name' => 'Housekeeping & Cleaning',
            'parent_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('expense_categories')->insert([
            'id' => 5,
            'hotel_id' => 0,
            'name' => 'Electricity',
            'parent_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('expense_categories')->insert([
            'id' => 6,
            'hotel_id' => 0,
            'name' => 'Sales & Marketing',
            'parent_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('expense_categories')->insert([
            'id' => 7,
            'hotel_id' => 0,
            'name' => 'Employee Salaries & Benefits',
            'parent_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('expense_categories')->insert([
            'id' => 8,
            'hotel_id' => 0,
            'name' => 'Technology & Software',
            'parent_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('expense_categories')->insert([
            'id' => 9,
            'hotel_id' => 0,
            'name' => 'Utilities',
            'parent_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('expense_categories')->insert([
            'id' => 10,
            'hotel_id' => 0,
            'name' => 'Taxes & Other Regulatory Fees',
            'parent_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('expense_categories')->insert([
            'id' => 11,
            'hotel_id' => 0,
            'name' => 'Administrative',
            'parent_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
