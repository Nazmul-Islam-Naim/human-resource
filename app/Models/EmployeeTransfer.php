<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class EmployeeTransfer extends Model
{
    use HasFactory;
    protected $table = 'employee_transfers';
    protected $fillable = [
        'general_information_id', 'workstation_id', 'designation_id', 'salary_scale_id',
        'salary', 'house_rent', 'total_taken_leave', 'allowance', 'transferred_date', 'joining_date', 'release_date', 'comment', 'discipline', 'transfer_document', 'release_document', 'join_document'
    ];

    //relationship

    public function generalInformation(){
        return $this->belongsTo(GeneralInformation::class);
    }

    public function district(){
        return $this->belongsTo(District::class);
    }

    public function workstation(){
        return $this->belongsTo(Workstation::class);
    }

    public function designation(){
        return $this->belongsTo(Designation::class);
    }

    public function salaryScale(){
        return $this->belongsTo(SalaryScale::class);
    }

    public function documents():MorphMany {
        return $this->morphMany(DocumentHistory::class, 'documentable');
    }

}
