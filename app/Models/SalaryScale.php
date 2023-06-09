<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalaryScale extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'salary_scales';
    protected $fillable = ['name','salary','status'];
}
