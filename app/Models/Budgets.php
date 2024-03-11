<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budgets extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "department_id",
        "project_name",
        "allocated_amount",
        "allocation_date",
    ];

    public function department()
    {
        return $this->belongsTo(Departments::class);
    }
}
