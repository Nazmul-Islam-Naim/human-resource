<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class GeneralInformation extends Model
{
    use HasFactory;
    protected $table = 'general_information';
    protected $fillable = [
        'employee_id', 'name_in_bangla', 'name_in_english', 'fathers_name_in_bangla', 'mothers_name_in_bangla', 'district_id', 'maritial_status', 'birth_date', 'prl_date',
        'present_designation_id', 'present_workstation_id', 'salary_scale_id', 'joining_type', 'joining_date', 'joining_designation_id', 'main_designation_id', 'permanent_date', 'order_no',
        'permanent_address', 'present_address', 'nid', 'mobile', 'email', 'sex', 'maritial_status', 'spouse_name_in_bangla', 'occupation_id', 'spouse_district_id',
        'photo', 'document', 'status'
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

    public function mainDesignation(){
        return $this->belongsTo(Designation::class,'main_designation_id');
    }

    public function occupation(){
        return $this->belongsTo(Occupation::class,'occupation_id');
    }

    public function spouseDistrict(){
        return $this->belongsTo(District::class,'spouse_district_id');
    }

    public function educationalInformationFirst(){
        return $this->hasOne(EducationalInformation::class)->orderBy('id','desc');
    }

    public function trainingInformationFirst(){
        return $this->hasOne(TrainingInformation::class)->orderBy('id','desc');
    }

    public function publicationInformationFirst(){
        return $this->hasOne(PublicationInformation::class)->orderBy('id','desc');
    }

    public function promotionInformationFirst(){
        return $this->hasOne(PromotionInformation::class)->orderBy('id','desc');
    }

    public function caseInformationFirst(){
        return $this->hasOne(CaseInformation::class)->orderBy('id','desc');
    }
    // one to many
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

    public function employeePensionPrl(){
        return $this->hasOne(EmployeePensionPrl::class);
    }

    public function transferStatus(){
        return $this->hasOne(TransferStatus::class);
    }

    public function documents() {
        return $this->hasMany(DocumentHistory::class);
    }

    public function offerLetters():MorphMany {
        return $this->morphMany(DocumentHistory::class, 'documentable');
    }

}
