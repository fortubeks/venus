<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'James Doe',
            'email' => 'james@doe.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'user_type' => 'super_admin',
            'phone' => '08090839412',
            'user_account_id' => 1,
            'hotel_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Jon Doe',
            'email' => 'jon@doe.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'user_type' => 'accounts',
            'phone' => '08090839412',
            'user_account_id' => 1,
            'hotel_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}