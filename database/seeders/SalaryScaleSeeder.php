<?php

namespace Database\Seeders;

use App\Models\SalaryScale;
use Illuminate\Database\Seeder;

class SalaryScaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $salaryScales = ['৯ম','১০ম']; 

        foreach($salaryScales as $salaryScale){
            SalaryScale::updateOrCreate([
                'name' => $salaryScale,
                'salary' => '২২৫০০',
            ]); 
        }
    }
}
