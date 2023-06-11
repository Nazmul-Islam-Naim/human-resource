<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingInformation extends Model
{
    use HasFactory;
    protected $table = 'training_information';
    protected $fillable = ['general_information_id', 'course_id', 'institute_id', 'date_from', 'date_to', 'comment', 'document'];

    //realtionship

    public function generalInformation(){
        return $this->belongsTo(GeneralInformation::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function institute(){
        return $this->belongsTo(Institute::class);
    }
}
