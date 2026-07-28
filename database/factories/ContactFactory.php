<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Contact::class;
    public function definition(): array
    {
        return [
            'user_id'    => User::factory(),
            'department' => $this->faker->randomElement([
                'Sales',
                'Support',
                'Accounts',
                'Technical',
                'General Inquiry'
            ]),
            'subject'    => $this->faker->sentence(4),
            'company'    => $this->faker->company(),
            'message'    => $this->faker->paragraph(),
        ];
    }
}
