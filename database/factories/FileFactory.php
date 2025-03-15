<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\File>
 */
class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fileable = $this->faker->randomElement([
            Post::class,
            Comment::class,
        ]);
        return [
            'name' => fake()->word.'.'.fake()->fileExtension(), // Генерируем имя файла
            'fileable_id' => $fileable::query()->inRandomOrder()->first()->id,
            'fileable_type' => $fileable
        ];
    }
}
