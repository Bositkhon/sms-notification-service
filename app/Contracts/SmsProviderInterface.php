<?php

namespace App\Contracts;

use App\DTOs\SmsSendResult;
use App\Exceptions\SmsServiceException;

interface SmsProviderInterface
{
    /**
     * Summary of send
     * @param string $to
     * @param string $message
     * @return void
     * @throws SmsServiceException
     */
    public function send(string $to, string $message): SmsSendResult;
}
