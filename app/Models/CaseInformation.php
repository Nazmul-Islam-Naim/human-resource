<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseInformation extends Model
{
    use HasFactory;
    protected $table = 'case_information';
    protected $fillable = ['general_information_id', 'case_no', 'punishment', 'punishment_order_date', 'release', 'release_order_date', 'comment', 'document'];

    //relationship

    public function generalInformation(){
        return $this->belongsTo(GeneralInformation::class);
    }
}
