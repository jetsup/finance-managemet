<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "head_id",
    ];

    public function head()
    {
        return $this->belongsTo(Employees::class, "head_id");
    }

    public function budgets()
    {
        return $this->hasMany(Budgets::class);
    }
}
