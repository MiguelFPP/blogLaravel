<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\This;
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
    public function definition()
    {
        $title = $this->faker->unique()->word;
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'body' => $this->faker->text(250),
            'content' => $this->faker->text(1500),
            'image'=> 'posts/' . $this->faker->image('public/storage/posts', 640, 480, null, false),
            'status' => $this->faker->randomElement([1, 0]),
            'user_id' => User::all()->random()->id,
            'category_id' => Category::all()->random()->id,
        ];
    }
}
