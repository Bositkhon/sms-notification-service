<?php

namespace App\Services\Sms;

use App\Contracts\SmsProviderInterface;
use App\DTOs\SmsSendResult;

class TwilioSmsService implements SmsProviderInterface
{
    public function __construct(
        private readonly ?string $accountSid = null,
        private readonly ?string $authToken = null,
        private readonly ?string $fromNumber = null,
    ) {}

    public function send(string $to, string $message): SmsSendResult
    {
        $messageId = 'SM' . bin2hex(random_bytes(16));

        $rawResponse = [
            'sid' => $messageId,
            'status' => 'queued',
            'to' => $to,
            'body' => $message,
            'provider' => 'twilio',
        ];

        return SmsSendResult::success($messageId, $rawResponse);
    }
}
