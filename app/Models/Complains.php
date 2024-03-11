<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complains extends Model
{
    use HasFactory;

    protected $fillable = [
        "prev_complain_id",
        "for",
        "from",
        "subject",
        "message",
    ];

    public function employee()
    {
        return $this->belongsTo(Employees::class, "for");
    }
}
