<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blocking extends Model
{
    //
    use HasFactory;

    protected $fillable = [

        'ip',
        'count',
        'blocking',

    ];

    protected $casts = [

        'ip' => 'string',
        'count' => 'integer',
        'blocking' => 'boolean',

    ];
}