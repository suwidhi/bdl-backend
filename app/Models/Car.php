<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'vin';

    protected $fillable = [
        'vin', 'brand', 'type', 'model', 'option', 'price'
    ];

    protected $casts = [
        'vin' => 'string',
    ];
}
