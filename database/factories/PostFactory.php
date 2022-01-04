<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->realText;
        $slug = Str::slug($title);
        $description = $this->faker->realText(1500);
        $excerpt = Str::words($description,20);

        return [
            "title" => $this->faker->realText,
            'slug' => $slug,
            "category_id" => Category::all()->random()->id,
            "description" => $description,
            "excerpt" => $excerpt,
            "user_id" => User::all()->random()->id,
            "isPublish" => 1
        ];
    }
}
