<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTransfer extends Model
{
    use HasFactory;

    protected $table = "employee_transfers";
    protected $fillable = [
    	'employee_id',
        'main_designation_id',
        'district_id',
        'present_workstation_id',
        'present_workstation_designation_id',
        'salary_scale_id',
        'salary',
        'house_rent',
        'transferred_workstation_id',
        'transferred_workstation_designation_id',
        'present_workstation_joining_date',
        'transferred_workstation_date',
        'transferred_workstation_joining_date',
        'total_taken_leave',
        'allowance',
        'status'
    ];

    public function user_department_object()
    {
        return $this->hasOne('App\Models\Department', 'id', 'department_id');
    }
   
    public function user_main_designation_object()
    {
        return $this->hasOne('App\Models\Designation', 'id', 'main_designation_id');
    }
    public function user_salary_scale_object()
    {
        return $this->hasOne('App\Models\SalaryScale', 'id', 'salary_scale_id');
    }
    public function user_district_object()
    {
        return $this->hasOne('App\Models\District', 'id', 'district_id');
    }
    public function user_type_object()
    {
        return $this->hasOne('App\Models\User', 'id', 'employee_id');
    }

    // ============== present data ===========

    public function user_present_designation_object()
    {
        return $this->hasOne('App\Models\Designation', 'id', 'transferred_workstation_designation_id');
    }

    public function user_present_workstation_object()
    {
        return $this->hasOne('App\Models\Workstation', 'id', 'transferred_workstation_id');
    }

    // ============== previous data ===========

    public function user_previous_designation_object()
    {
        return $this->hasOne('App\Models\Designation', 'id', 'present_workstation_designation_id');
    }

    public function user_previous_workstation_object()
    {
        return $this->hasOne('App\Models\Workstation', 'id', 'present_workstation_id');
    }

}