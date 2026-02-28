<?php

namespace App\Services\Sms;

use App\Contracts\SmsProviderInterface;
use App\DTOs\SmsSendResult;

class EskizSmsService implements SmsProviderInterface
{
    public function __construct(
        private readonly ?string $apiToken = null,
        private readonly ?string $baseUrl = 'https://notify.eskiz.uz/api',
    ) {}

    public function send(string $to, string $message): SmsSendResult
    {
        $messageId = 'eskiz_' . uniqid('', true);

        $rawResponse = [
            'id' => $messageId,
            'status' => 'sent',
            'to' => $to,
            'message' => $message,
            'provider' => 'eskiz',
        ];

        return SmsSendResult::success($messageId, $rawResponse);
    }
}
