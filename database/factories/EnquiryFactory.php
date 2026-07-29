<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Enquiry;
use App\Models\User;
use App\Models\Product;
use App\Models\Accessory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EnquiryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Enquiry::class;
    public function definition(): array
    {
        return [
            'user_id'      => User::factory(),
            'product_id'   => Product::inRandomOrder()->value('id'),
            // 'accessory_id' => Accessory::inRandomOrder()->value('id'),
            'message'      => $this->faker->paragraph(),
            'status'       => 'New',
        ];
    }
}
