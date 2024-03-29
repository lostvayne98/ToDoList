<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ListsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'  => $this->faker->name(),
            'user_id' => auth()->loginUsingId(1),
            'status' => true
        ];
    }
}
