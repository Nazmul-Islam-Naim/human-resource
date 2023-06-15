<?php

namespace Database\Seeders;

use App\Models\Workstation;
use Illuminate\Database\Seeder;

class WorkstationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $workstations = ['প্রশাসনিক বিভাগ','পাবলিকেশন বিভাগ'];

        foreach($workstations as $workstation){
            Workstation::updateOrCreate([
                'name' => $workstation,
                'description' => $workstation,
            ]); 
        }
    }
}
