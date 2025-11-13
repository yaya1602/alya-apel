<?php

namespace Database\Seeders;

use run;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateFirstUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $data['name']     = 'Admin';
        $data['email']    = 'alya@gmail.com';
        $data['password'] = Hash::make('alya');
        User::create($data);
    }
}
