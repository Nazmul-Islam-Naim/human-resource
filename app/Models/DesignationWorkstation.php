<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignationWorkstation extends Model
{
    use HasFactory;
    protected $table = 'designation_workstations';
    protected $fillable = ['workstation_id', 'designation_id', 'general_information_id', 'joining_date', 'release_date'];

    //relationship
    public function workstation(){
        return $this->belongsTo(Workstation::class);
    }

    public function designation(){
        return $this->belongsTo(Designation::class);
    }

    public function generalInformation(){
        return $this->belongsTo(GeneralInformation::class);
    }
}
