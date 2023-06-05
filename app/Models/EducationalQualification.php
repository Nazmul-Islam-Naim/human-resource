<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalQualification extends Model
{
    use HasFactory;
    protected $table = 'educational_qualifications';
    protected $fillable = [
        'general_information_id', 'institution_name', 'principal_subject', 'degree', 'passing_year', 'result', 'distinction'
    ];
    
    // relationship

    public function generalInformation(){
        return $this->belongsTo(GeneralInformation::class);
    }
}
