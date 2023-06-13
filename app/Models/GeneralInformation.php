<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GeneralInformation extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'general_information';
    protected $fillable = [
        'employee_id', 'name_in_bangla', 'name_in_english', 'fathers_name_in_bangla', 'mothers_name_in_bangla', 'district_id', 'maritial_status', 'birth_date', 
        'prl_date', 'present_designation_id', 'present_workstation_id', 'salary_scale_id', 'joining_date', 'joining_designation_id', 'permanent_date', 'order_no',
        'permanent_address', 'present_address', 'mobile', 'email', 'sex', 'maritial_status', 'spouse_name_in_bangla', 'occupation_id', 'spouse_district_id',
        'photo', 'signature', 'status'
    ];

    // relationship

    public function district(){
        return $this->belongsTo(District::class);
    }

    public function presentDesignation(){
        return $this->belongsTo(Designation::class,'present_designation_id');
    }

    public function presentWorkStation(){
        return $this->belongsTo(Workstation::class,'present_workstation_id');
    }

    public function salaryScale(){
        return $this->belongsTo(SalaryScale::class,'salary_scale_id');
    }

    public function joiningDesignation(){
        return $this->belongsTo(Designation::class,'joining_designation_id');
    }

    public function occupation(){
        return $this->belongsTo(Occupation::class,'occupation_id');
    }

    public function spouseDistrict(){
        return $this->belongsTo(District::class,'spouse_district_id');
    }

    public function educationalInformation(){
        return $this->hasMany(EducationalInformation::class);
    }

    public function trainingInformation(){
        return $this->hasMany(TrainingInformation::class);
    }

    public function publicationInformation(){
        return $this->hasMany(PublicationInformation::class);
    }

    public function promotionInformation(){
        return $this->hasMany(PromotionInformation::class);
    }

    public function caseInformation(){
        return $this->hasMany(CaseInformation::class);
    }

    public function employeeTransfer(){
        return $this->hasMany(EmployeeTransfer::class);
    }

}
