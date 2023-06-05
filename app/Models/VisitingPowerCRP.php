<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitingPowerCRP extends Model
{
    use HasFactory;
    protected $table = 'visiting_power_c_r_p_s';
    protected $fillable = [
        'general_information_id', 'power', 'notification_date'
    ];
    
    // relationship

    public function generalInformation(){
        return $this->belongsTo(GeneralInformation::class);
    }
}
