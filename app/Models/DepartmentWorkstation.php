<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentWorkstation extends Model
{
    use HasFactory;
    protected $table = 'department_workstations';
    protected $fillable = ['department_id', 'workstation_id'];

    //relationship
    public function department(){
        return $this->belongsTo(Department::class);
    }
    public function workstation(){
        return $this->belongsTo(Workstation::class);
    }
}
