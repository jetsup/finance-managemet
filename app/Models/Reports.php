<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    use HasFactory;
    protected $fillable = [
        'from',
        'to',
        'generated_by',
        "transaction_type_id",
    ];

    public function employee()
    {
        return $this->belongsTo(Employees::class, "generated_by");
    }
}
