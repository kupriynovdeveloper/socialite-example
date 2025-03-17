<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DbListenLog extends Model
{
    protected $fillable = [
        'user',
        'count_requests',
        'sql',
        'status',
        'time',
        'message',
        'route'
    ];

    public static function createModel(): DbListenLog
    {
        return new self();
    }
}
