<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeptManager extends Model
{
    use HasFactory;
    protected $table = 'dept_manager'; 
    
    public $timestamps = false;
    
    protected $fillable = [
        'emp_no', 'dept_no', 'from_date' ,'to_date'
    ];
    protected $keyType = 'array'; 
    protected $primaryKey = ['emp_no','dept_no','from_date'];

    public $incrementing = false;

    protected $dates = ['birth_date', 'hire_date', 'baja'];

    public function department()
    {
        // Relación de muchos a uno
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }


}
