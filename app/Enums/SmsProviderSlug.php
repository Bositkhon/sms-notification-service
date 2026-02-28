<?php

namespace App\Enums;

enum SmsProviderSlug: string
{
    use EnumTrait;
    case ESKIZ = 'eskiz';
    case PLAYMOBILE = 'playmobile';
    case TWILIO = 'twilio';
}
