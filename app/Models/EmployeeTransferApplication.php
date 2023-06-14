<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTransferApplication extends Model
{
    use HasFactory;
    protected $table = "employee_transfer_applications";
    protected $fillable = [
    	'employee_transfer_id',
    	'transfer_number',
    	'first_paragraph',
        'present_designation_id',
        'present_workstation_id',
        'trans_designation_id',
        'trans_workstation_id',
        'user_id',
        'transferred_workstation_date',
        'editordata1',
        'editordata2',
    ];

    //relationship
    
    public function employeeTransfer(){
        return $this->belongsTo(EmployeeTransfer::class);
    }

    public function presentDesignation(){
        return $this->belongsTo(Designation::class, 'present_designation_id');
    }

    public function presentWorkstation(){
        return $this->belongsTo(Workstation::class, 'present_workstation_id');
    }

    public function transferredDesignation(){
        return $this->belongsTo(Designation::class, 'trans_designation_id');
    }

    public function transferredWorkstation(){
        return $this->belongsTo(Workstation::class, 'trans_workstation_id');
    }

    public function signatureBy(){
        return $this->belongsTo(User::class,'user_id');
    }
}
