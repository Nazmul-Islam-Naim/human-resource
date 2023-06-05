<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLedger extends Model
{
    use HasFactory;

    protected $table = "employee_ledger";
    protected $fillable = [
        'date', 'bank_id', 'employee_id', 'month', 'amount', 'reason', 'tok', 'note', 'created_by'
    ];

    public function ledger_user_object()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }

    public function ledger_employee_object()
    {
        return $this->hasOne('App\Models\Employee', 'id', 'employee_id');
    }
}