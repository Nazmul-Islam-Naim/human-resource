<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferStatus extends Model
{
    use HasFactory;
    protected $table = 'transfer_statuses';
    protected $fillable = [
        'general_information_id', 'present_joining_date', 'workstation_id', 'designation_id', 'previous_joining_date', 'comment', 'discipline'
    ];

    //relationship

    public function generalInformation(){
        return $this->belongsTo(GeneralInformation::class);
    }

    public function previousWorkstation(){
        return $this->belongsTo(Workstation::class, 'workstation_id');
    }

    public function previousDesignation(){
        return $this->belongsTo(Designation::class, 'designation_id');
    }
}
