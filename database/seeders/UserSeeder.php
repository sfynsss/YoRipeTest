<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            ['name' => 'Admin', 'email' => 'admin@gmail.com', 'password' => Hash::make('12345678'), 'role' => 1, 'created_at' => Carbon::now()->timezone('Asia/Jakarta'), 'updated_at' => Carbon::now()->timezone('Asia/Jakarta')],
            ['name' => 'Manager', 'email' => 'manager@gmail.com', 'password' => Hash::make('12345678'), 'role' => 2, 'created_at' => Carbon::now()->timezone('Asia/Jakarta'), 'updated_at' => Carbon::now()->timezone('Asia/Jakarta')],
            ['name' => 'User', 'email' => 'user@gmail.com', 'password' => Hash::make('12345678'), 'role' => 3, 'created_at' => Carbon::now()->timezone('Asia/Jakarta'), 'updated_at' => Carbon::now()->timezone('Asia/Jakarta')]
        ];
        
        DB::table('users')->insert($user);
        $this->command->info('Users table has been stored!');
    }
}
