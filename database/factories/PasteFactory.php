<?php

namespace Database\Factories;

use App\Models\Paste;
use Illuminate\Database\Eloquent\Factories\Factory;

class PasteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Paste::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->text(),
            'slug' => $this->faker->slug()
        ];
    }
}
