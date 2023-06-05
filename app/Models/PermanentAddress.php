<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermanentAddress extends Model
{
    use HasFactory;
    protected $table = 'permanent_addresses';
    protected $fillable = [
        'general_information_id', 'village', 'post_office', 'police_station', 'district_id', 'telephone', 'moblie', 'eamil'
    ];

    // relationship

    public function generalInformation(){
        return $this->belongsTo(GeneralInformation::class);
    }

    public function district(){
        return $this->belongsTo(District::class);
    }
}
