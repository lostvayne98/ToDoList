<?php

namespace Database\Factories;

use App\Models\Lists;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => auth()->loginUsingId(1),
            'lists_id' => Lists::get()->random()->id,
            'name' => $this->faker->name(7)
        ];
    }
}
