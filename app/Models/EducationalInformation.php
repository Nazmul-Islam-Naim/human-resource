<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalInformation extends Model
{
    use HasFactory;
    protected $table = 'educational_information';
    protected $fillable = ['general_information_id', 'degree_id', 'passing_year_id', 'reading_subject_id', 'board_id', 'result', 'document'];

    //relationship

    public function generalInformation(){
        return $this->belongsTo(GeneralInformation::class);
    }

    public function degree(){
        return $this->belongsTo(Degree::class);
    }

    public function passingYear(){
        return $this->belongsTo(PassingYear::class);
    }

    public function readingSubject(){
        return $this->belongsTo(ReadingSubject::class);
    }

    public function board(){
        return $this->belongsTo(Board::class);
    }
}
