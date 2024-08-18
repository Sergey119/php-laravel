<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    //#[ArrayShape()] public function definition() : array
    public function definition()
    {
        $title = fake()->realText(rand(10, 25));
        $short_title = mb_strlen($title)>20 ? mb_substr($title, 0, 20) . '...' : $title;
        $created = fake()->dateTimeBetween("-30 days", "-1 days");

        return [
            'title' => $title,
            'short_title' => $short_title,
            'author_id' => rand(1,4),
            'des' => fake()->realText(rand(100, 500)),
            'created_at' => $created,
            'updated_at' => $created,
        ];
    }
}
