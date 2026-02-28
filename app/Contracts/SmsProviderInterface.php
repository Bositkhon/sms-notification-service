<?php

namespace App\Contracts;

use App\DTOs\SmsSendResult;

interface SmsProviderInterface
{
    public function send(string $to, string $message): SmsSendResult;
}
