<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $districts = ['ঢাকা','বরিশাল'];

        foreach($districts as $district){
            District::updateOrCreate([
                'name' => $district,
            ]); 
        }
    }
}
