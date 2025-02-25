<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees'; 
    
    public $timestamps = false;
    
    protected $fillable = [
        'emp_no', 'birth_date', 'first_name', 'last_name', 'gender', 'hire_date', 'baja'
    ];

    protected $primaryKey = 'emp_no';

    public $incrementing = false;

    protected $keyType = 'integer';

    protected $dates = ['birth_date', 'hire_date', 'baja'];
}
?>