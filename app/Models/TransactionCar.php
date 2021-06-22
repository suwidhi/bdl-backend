<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionCar extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction', 'car'
    ];
}
