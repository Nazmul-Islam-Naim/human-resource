<?php

namespace Database\Seeders;

use App\Models\GeneralInformation;
use App\Models\TransferStatus;
use Illuminate\Database\Seeder;

class TransferStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransferStatus::updateOrCreate([
            'general_information_id' => GeneralInformation::first()->id,
            'present_joining_date' => '2019-06-25',
        ]); 
        
    }
}
