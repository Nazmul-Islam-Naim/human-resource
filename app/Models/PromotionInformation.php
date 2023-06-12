<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionInformation extends Model
{
    use HasFactory;
    protected $table = 'promotion_information';
    protected $fillable = ['general_information_id', 'designation_id', 'promotion_date', 'order_no', 'date', 'salary_scale_id'];

    //relationship

    public function generalInformation(){
        return $this->belongsTo(GeneralInformation::class);
    }

    public function promotionDesignation(){
        return $this->belongsTo(Designation::class,'designation_id');
    }

    public function salaryScale(){
        return $this->belongsTo(SalaryScale::class);
    }
}
