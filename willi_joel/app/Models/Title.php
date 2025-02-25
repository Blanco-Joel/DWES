<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    use HasFactory;
    protected $table = 'titles'; 
    
    public $timestamps = false;
    
    protected $fillable = [
        'emp_no', 'title', 'from_date' ,'to_date'
    ];
    protected $keyType = 'array'; 
    protected $primaryKey = ['emp_no','title', 'from_date'];

    public $incrementing = false;

    protected $dates = ['birth_date', 'hire_date', 'baja'];
}
