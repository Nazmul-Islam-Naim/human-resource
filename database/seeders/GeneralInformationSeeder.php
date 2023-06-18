<?php

namespace Database\Seeders;

use App\Enum\MaritialStatusEnum;
use App\Enum\SexEnum;
use App\Models\Designation;
use App\Models\District;
use App\Models\GeneralInformation;
use App\Models\SalaryScale;
use App\Models\Workstation;
use Illuminate\Database\Seeder;

class GeneralInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GeneralInformation::updateOrCreate([
            'name_in_bangla' => 'নাজমুল ইসলাম নাঈম',
            'fathers_name_in_bangla' => 'জুলহাস হাওলাদার',
            'mothers_name_in_bangla' => 'সাহিদা বেগম',
            'birth_date' => '1997-06-25',
            'prl_date' => '2056-06-25',
            'joining_date' => '2019-06-25',
            'district_id' => District::first()->id,
            'present_designation_id' => Designation::first()->id,
            'present_workstation_id' => Workstation::first()->id,
            'salary_scale_id' => SalaryScale::first()->id,
            'joining_designation_id' => Designation::first()->id,
            'sex' => SexEnum::Male,
            'maritial_status' => MaritialStatusEnum::Single,
        ]); 
        
    }
}
