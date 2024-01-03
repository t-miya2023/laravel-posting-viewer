<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User; // ユーザーモデル
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::factory()->create();

        return [
            'user_id' => $user->id,
            'shop_id' => fake()->numberBetween(132, 282),
            'title' => fake()->realText(20),
            'content' => fake()->realText(),
            'rating' => fake()->numberBetween(1, 5),
        ];
    }
}
