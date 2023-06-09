<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_permissions = Permission::all();
        Role::updateOrCreate(['title' => 'Admin', 'slug' => 'admin', 'deletable' => false])
            ->permissions()
            ->sync($admin_permissions->pluck('id'));

        Role::updateOrCreate(['title' => 'User', 'slug' => 'user', 'deletable' => false])
            ->permissions()
            ->sync([]);        

        Role::updateOrCreate(['title' => 'মহাপরিচলাক', 'slug' => 'mohaporicalok', 'deletable' => false])
            ->permissions()
            ->sync([]);        
        Role::updateOrCreate(['title' => 'সচিব', 'slug' => 'socib', 'deletable' => false])
            ->permissions()
            ->sync([]);         
        Role::updateOrCreate(['title' => 'সহকারী সচিব', 'slug' => 'sahokari-socib', 'deletable' => false])
            ->permissions()
            ->sync([]);         
        Role::updateOrCreate(['title' => 'উপ-সহকাররী সচিব', 'slug' => 'upo-sohokari-socib', 'deletable' => false])
            ->permissions()
            ->sync([]);         

    }
}
