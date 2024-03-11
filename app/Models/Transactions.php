<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $fillable = [
        "transaction_date",
        "transaction_type_id",
        "from_account_id",
        "to_account_id",
        "amount",
        "transaction_code",
    ];
}
