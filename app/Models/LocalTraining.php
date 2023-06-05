<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalTraining extends Model
{
    use HasFactory;
    protected $table = 'local_trainings';
    protected $fillable = [
        'general_information_id', 'course_title', 'institution', 'location', 'from', 'to', 'grade', 'position'
    ];

    // relationship

    public function generalInformation(){
        return $this->belongsTo(GeneralInformation::class);
    }
}
