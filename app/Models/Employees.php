<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;

    protected $fillable = [
        "employee_number",
        "user_id",
        "employee_type_id",
        "department_id",
    ];

    public function messages()
    {
        return $this->hasMany(EmployeeMessages::class, "for");
    }

    public function reports()
    {
        return $this->hasMany(Reports::class, "generated_by");
    }

    public function complains()
    {
        return $this->hasMany(Complains::class, "for");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employee_type()
    {
        return $this->belongsTo(EmployeeTypes::class);
    }

    public function payments() {
        return $this->hasMany(EmployeePayments::class);
    }
}
