<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop>
 */
class ShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'shop_name' => fake()-> company(),
            'shop_desc' => fake()-> realText(),
            'post_code' => fake()-> postcode(),
            'prefecture' => app('county'),
            'address' => fake()->streetAddress(),
            'tel' => fake()->phoneNumber(),
            'shop_email' => fake()->safeEmail(),
            'business_hours' => fake()->time(),
        ];
    }
}
