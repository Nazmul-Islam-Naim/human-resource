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
        'psc_merit_serial', 'name_in_bangla', 'name_in_english', 'district_id', 'birth_date', 'posting', 'location', 'sex', 'maritial_status', 'nid', 
        'fathers_name_in_bangla', 'fathers_name_in_english', 'mothers_name_in_bangla', 'mothers_name_in_english', 'joining_date', 'go_date', 'religion',
        'freedom_fighter', 'freedom_fighter_child', 'photo', 'signature', 'status'
    ];

    // relationship

    public function district(){
        return $this->belongsTo(District::class);
    }

    public function spouseInformation(){
        return $this->hasOne(SpouseInformation::class);
    }

    public function permanentAddress(){
        return $this->hasOne(PermanentAddress::class);
    }

    public function presentAddress(){
        return $this->hasOne(PresentAddress::class);
    }

    public function childrenInformation(){
        return $this->hasMany(ChildrenInformation::class);
    }

    public function visitingPower(){
        return $this->hasMany(VisitingPowerCRP::class);
    }

    public function educationalQualification(){
        return $this->hasMany(EducationalQualification::class);
    }

    public function localTraining(){
        return $this->hasMany(LocalTraining::class);
    }

}
