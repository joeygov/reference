<?php

namespace Database\Seeders;

use App\Models\Employee;
use Database\Factories\EmployeeFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $factory = new EmployeeFactory();
        for ($i = 0; $i < 10; ++$i) {
            $employee = new Employee($factory->definition());
            $employee->save();
        }
    }
}
