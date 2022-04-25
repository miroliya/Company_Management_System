<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
    		'name' => 'superadmin',
    		'email' => 'admin@admin.com',
    		'password' => Hash::make('admin@123'),
    		'phone' => '01810000000',
            'user_permission' => '1,2,3,4',
            'user_status' => 1,
    		'created_at' => date('Y-m-d'),
    		'updated_at' => date('Y-m-d')
    	]);
    }
}
