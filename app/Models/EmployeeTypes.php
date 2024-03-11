<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTypes extends Model
{
    use HasFactory;

    protected $fillable = [
        "employee_type"
    ];

    public function employees()
    {
        return $this->hasMany(Employees::class);
    }
}
