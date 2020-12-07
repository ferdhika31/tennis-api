<?php

namespace Database\Factories;

use App\Models\Container;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContainerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Container::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => "Container {$this->faker->buildingNumber}",
            'max_balls' => $this->faker->numberBetween(4, 7),
        ];
    }
}
