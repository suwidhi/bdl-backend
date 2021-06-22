<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $keyType = 'string';

    protected $primaryKey = 'code';

    protected $fillable = [
        'code', 'supplier', 'manufacturer', 'model', 'name', 'description'
    ];

    protected $casts = [

    ];
}
