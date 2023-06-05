<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpouseInformation extends Model
{
    use HasFactory;
    protected $table = 'spouse_information';
    protected $fillable = [
        'general_information_id', 'name_in_bangla', 'name_in_english', 'district_id', 'occupation_id', 'designation_id', 'location'
    ];

    // relationship

    public function generalInformation(){
        return $this->belongsTo(GeneralInformation::class);
    }

    public function district(){
        return $this->belongsTo(District::class);
    }

    public function occupation(){
        return $this->belongsTo(Occupation::class);
    }

    public function designation(){
        return $this->belongsTo(Designation::class);
    }
}
