<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = \Faker\Factory::create('en_US');

        $name        =  $this->faker->unique()->word();
        $slug        =  strtolower($name);
        $description =  $this->faker->text(240);
        $price       =  $this->faker->numberBetween(199, 29999);
        $inStock     =  $this->faker->numberBetween(1, 99);

        return [
            'name'        => $name,
            'slug'        => $slug,
            'instock'     => $inStock,
            'price'       => $price,
            'description' => $description
        ];
    }
}
