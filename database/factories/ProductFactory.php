<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uuid'           => $this->faker->uuid,
            'name'           => $this->faker->unique()->word,
            'description'    => $this->faker->sentence(),
            'photo'          => $this->faker->imageUrl(),
            'price'          => rand(50000, 100000),           // prices between 50 and 100 euros, in cents.
            'stock_quantity' => rand(1, 10),
        ];
    }
}
