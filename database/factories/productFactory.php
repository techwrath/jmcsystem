<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class productFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'productName' => $this->faker->word,
            'productDescription' => $this->faker->sentence,
            'productBrand' => $this->faker->word, 
            'productImage' => $this->faker->imageUrl(640, 480, 'technics', true, 'Faker'), 
            'productCode' => $this->faker->word,
            'userId' => '1',
        ];
    }
}
