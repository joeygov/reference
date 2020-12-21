<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'emp_id' => $this->faker->unique()->randomNumber($nbDigits = 8),
            'first_name' => $this->faker->firstname,
            'last_name' => $this->faker->lastname,
            'user_role' => $this->faker->randomElement([Employee::USER, Employee::WFM, Employee::ADMIN, Employee::REPORT_MANAGER]),
            'email' => $this->faker->unique()->safeEmail,
            'is_wfh' => $this->faker->randomElement([true, false]),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}
