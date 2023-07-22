<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name'=>'Faten Hmaid',
            'email'=>'f@hmaid.ps',
            'password'=> Hash::make('password'),
            'phone_number'=>'970591234',
        ]);
        DB::table('users')->insert([
            'name'=>'System Admin',
            'email'=>'sys@hmaid.ps',
            'password'=> Hash::make('password'),
            'phone_number'=>'970591238',
        ]);
    }
}
    

