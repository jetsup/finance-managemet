<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePayments extends Model
{
    use HasFactory;

    protected $fillable = [
        "employee_id",
        "due_amount",
        "total_received",
        "transaction_id",
    ];

    public function employee() {
        return $this->belongsTo(Employees::class);
    }
}
