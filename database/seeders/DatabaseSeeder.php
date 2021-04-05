<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Department;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => "$2y$10\$UpPMm5Lj.9pqK40RW.SJIOTC6FI3XXaWVx.O1Qxyb5B12HDHE1R3G",
            "role"=>"admin",
            "age"=>30,
            "department_id"=>1
        ]);

        Department::create([
            "id"=>1,
            "name"=>"Human Resources",
            "description"=>"This is the human resources department.",
            "parent_id"=>NULL
        ]);

        Department::create([
            "id"=>2,
            "name"=>"IT",
            "description"=>"This is the IT department.",
            "parent_id"=>NULL
        ]);

        Department::factory(7)->create()->each(function ($user){
            $user->users()->saveMany(User::factory(3)->make());
        });

    }
}
