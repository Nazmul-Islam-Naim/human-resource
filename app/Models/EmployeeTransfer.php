<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTransfer extends Model
{
    use HasFactory;
    protected $table = 'employee_transfers';
    protected $fillable = [
        'general_information_id', 'district_id', 'workstation_id', 'designation_id', 'salary_scale_id',
        'salary', 'house_rent', 'total_taken_leave', 'allowance', 'transferred_date', 'joining_date', 'release_date', 'comment'
    ];

    //relationship

    public function generalInformation(){
        return $this->belongsTo(GeneralInformation::class);
    }

    public function district(){
        return $this->belongsTo(District::class);
    }

    public function workstation(){
        return $this->belongsTo(Workstation::class);
    }

    public function designation(){
        return $this->belongsTo(Designation::class);
    }

    public function salaryScale(){
        return $this->belongsTo(SalaryScale::class);
    }
}
