<?php

namespace App\Enums;

enum SmsMessageStatus: string
{
    use EnumTrait;

    case SENT = 'sent';
    case FAILED = 'failed';
    case PENDING = 'pending';
}
