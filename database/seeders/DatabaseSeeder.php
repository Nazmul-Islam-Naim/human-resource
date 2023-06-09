<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(DesignationSeeder::class);
        $this->call(userSeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(WorkstationSeeder::class);
        $this->call(SalaryScaleSeeder::class);
        // $this->call(GeneralInformationSeeder::class);
        // $this->call(TransferStatusSeeder::class);
        // $this->call(EmployeeTransferSeeder::class);
    }
}
