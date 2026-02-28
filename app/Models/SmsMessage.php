<?php

namespace App\Models;

use App\Enums\SmsMessageStatus;
use Illuminate\Database\Eloquent\Model;

class SmsMessage extends Model
{
    protected $casts = [
        'status' => SmsMessageStatus::class
    ];
}
