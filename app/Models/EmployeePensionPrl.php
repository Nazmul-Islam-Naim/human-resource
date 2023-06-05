<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePensionPrl extends Model
{
    use HasFactory;

    protected $table = "employee_pension_prls";
    protected $fillable = [
    	'employee_id',
        'district_id',
        'dob',
        'prl_date',
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
        'status'
    ];
    public function user_district_object()
    {
        return $this->hasOne('App\Models\District', 'id', 'district_id');
    }
    public function user_type_object()
    {
        return $this->hasOne('App\Models\User', 'id', 'employee_id');
    }


}