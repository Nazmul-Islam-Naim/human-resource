<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'departments';
    protected $fillable = ['name','status'];

    //relationship
    public function departments(){
        return $this->hasMany(DepartmentWorkstation::class);
    }
}
