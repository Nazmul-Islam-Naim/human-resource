<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildrenInformation extends Model
{
    use HasFactory;
    protected $table = 'children_information';
    protected $fillable = [
        'general_information_id', 'name_in_bangla', 'name_in_english', 'birth_date', 'sex'
    ];

    // relationship

    public function generalInformation(){
        return $this->belongsTo(GeneralInformation::class);
    }
}
