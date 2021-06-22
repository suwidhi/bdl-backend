<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarOption extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'engine', 'color', 'transmission'
    ];

    protected $casts = [
        'model' => 'string'
    ];
}
