<?php

namespace App\Models;

use App\Enums\SmsMessageStatus;
use Illuminate\Database\Eloquent\Model;

class SmsMessage extends Model
{
    protected $fillable = [
        'project_id',
        'message_id',
        'status',
        'to',
        'message'
    ];
    protected $casts = [
        'status' => SmsMessageStatus::class
    ];
}
