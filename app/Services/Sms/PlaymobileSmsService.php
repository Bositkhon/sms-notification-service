<?php

namespace App\Services\Sms;

use App\Contracts\SmsProviderInterface;
use App\DTOs\SmsSendResult;

class PlaymobileSmsService implements SmsProviderInterface
{
    public function __construct(
        private readonly ?string $username = null,
        private readonly ?string $password = null,
        private readonly ?string $baseUrl = 'https://send.smsx.uz/',
    ) {}

    public function send(string $to, string $message): SmsSendResult
    {
        $messageId = 'playmobile_' . uniqid('', true);

        $rawResponse = [
            'message-id' => $messageId,
            'status' => 'accepted',
            'recipient' => $to,
            'text' => $message,
            'provider' => 'playmobile',
        ];

        return SmsSendResult::success($messageId, $rawResponse);
    }
}
