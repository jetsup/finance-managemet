<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeMessages extends Model
{
    use HasFactory;

    protected $fillable = [
        "prev_msg_id",
        "for",
        "from",
        "message",
        "replied",
        "deleted",
    ];


    public function employee()
    {
        return $this->belongsTo(Employees::class, "for");
    }
}
