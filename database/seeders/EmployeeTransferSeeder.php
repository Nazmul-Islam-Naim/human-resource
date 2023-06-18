<?php

namespace Database\Seeders;

use App\Models\Designation;
use App\Models\EmployeeTransfer;
use App\Models\GeneralInformation;
use App\Models\SalaryScale;
use App\Models\Workstation;
use Illuminate\Database\Seeder;

class EmployeeTransferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EmployeeTransfer::updateOrCreate([
            'general_information_id' => GeneralInformation::first()->id,
            'workstation_id ' => Workstation::first()->id,
            'designation_id ' => Designation::first()->id,
            'salary_scale_id ' => SalaryScale::first()->id,
            'salary ' => SalaryScale::first()->salary,
            'joining_date ' => GeneralInformation::first()->joining_date,
        ]); 
        
    }
}
