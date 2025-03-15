<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'name_model',
        'name_event',
        'old_field',
        'new_field',
    ];

    protected $casts = [
        'old_field' => 'array',
        'new_field' => 'array'
    ];
}
