<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class EmployeePensionPrl extends Model
{
    use HasFactory;
    protected $table = "employee_pension_prls";
    protected $fillable = [
    	'general_information_id',
        'last_basic_salary',
        'leave_average_pay',
        'leave_half_pay',
        'due_provident_fund',
        'leave_encashment_owed',
        'amount_gratuity',
        'audit_objected_amount',
        'reason_audit_objections',
        'total_amount_owed',
        'amount_money_payable',
        'provident_fund',
        'leave_encashment',
        'gratuity',
        'amount_loan_taken',
        'reason_amount_loan_taken',
        'pension_document',
        'status'
    ];

    //relationship

    public function generalInformation(){
        return $this->belongsTo(GeneralInformation::class);
    }
    public function documents():MorphMany {
        return $this->morphMany(DocumentHistory::class, 'documentable');
    }
}
