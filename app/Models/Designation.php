<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug'];


    //relationships

    public function users(){
        return $this->hasMany(User::class);
    }

    public function designations(){
        return $this->hasMany(DesignationWorkstation::class, 'designation_id');
    }

    public function workingDesignations(){
        return $this->hasMany(DesignationWorkstation::class)->where('general_information_id', '!=', null);
    }

    public function zeroDesignations(){
        return $this->hasMany(DesignationWorkstation::class)->where('general_information_id', null);
    }
}
