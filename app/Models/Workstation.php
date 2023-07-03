<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Workstation extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'workstations';
    protected $fillable = ['name','description','status'];

    // relationship
    public function workstations(){
        return $this->hasMany(DesignationWorkstation::class);
    }
}
