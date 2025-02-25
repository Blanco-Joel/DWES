<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;
    protected $table = 'salaries'; 
    
    public $timestamps = false;
    
    protected $fillable = [
        'emp_no', 'salary', 'from_date' ,'to_date'
    ];
    protected $keyType = 'array'; 
    protected $primaryKey = ['emp_no', 'from_date'];

    public $incrementing = false;

    protected $dates = ['from_date','to_date'];
}
