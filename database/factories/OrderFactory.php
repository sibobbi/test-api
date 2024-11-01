<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        $randomDays = $this->faker->numberBetween(1, 10);
        $date = $this->faker->dateTimeBetween('-0 month', 'now');

// Преобразование в объект Carbon
        $carbonDate = Carbon::instance($date);

// Прибавление одного дня
        $carbonDate->addDays($randomDays);

        return [
            'product_id' => Product::inRandomOrder()->first()->id,
            'count' => $this->faker->numberBetween(1, 10),
            'created_at' => $carbonDate,
        ];
    }
}
