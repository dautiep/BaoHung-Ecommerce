<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $text = $this->faker->name;

        return [
            //
            'name' => $text,
            'slug' => Str::slug($text),
            'description' => $this->faker->text,
            'content' => $this->faker->text,
            'price' => $this->faker->numberBetween($min = 1500, $max = 6000),
            'category_id' => Category::all()->random()->id,
            'image_url' => "https://imgboats.com/assets/images/img400_".$this->faker->numberBetween($min = 1, $max = 5).".jpg"
        ];
    }
}
