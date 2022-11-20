<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $url = '/public/images/'.'1.jpg';
        $alt =  $this->faker->word();
        $description = $this->faker->text(120);
        $random_int = $this->faker->numberBetween(1, 125);

        return [
            'url'         => $url,
            'alt'         => $alt,
            'description' => $description,
            'product_id'  => $random_int,
        ];
    }
}
