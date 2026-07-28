<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ServiceEnquiry;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceEnquiry>
 */
class ServiceEnquiryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'service' => $this->faker->randomElement([
                'Calibration Services',
                'Maintenance Repair & Service',
                'Special Customisation',
                'Tools & Equipment Rental',
                'Asset Management',
                'EPC Projects Deliverables',
                'Commissioning Deliverables',
                'On-Site Execution',
            ]),
            'requirements' => $this->faker->paragraph(),
        ];
    }
}
