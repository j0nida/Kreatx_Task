<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Department;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;


class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $dir=public_path('images');
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'photo' => $this->faker->image($dir, 200, 200, null, false),
            "age"=>$this->faker->numberBetween(18, 60),
            "salary"=>$this->faker->randomFloat(3,200,1000),
            'password' => '$2y$10$pCgtyLUlJQ72vvphogV9EuhA3ZvYljb1td0Jy7dmqOjTtYMkvUUBi', // password
            'remember_token' => Str::random(10),
            "role"=>"employee",
            "department_id"=>Department::all(['id'])->random(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
