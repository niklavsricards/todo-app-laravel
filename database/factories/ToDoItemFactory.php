<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ToDoItemFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => null,
            'title' => $this->faker->text(30),
            'created_at' => $this->faker->date,
            'updated_at' => $this->faker->date,
        ];
    }
}
