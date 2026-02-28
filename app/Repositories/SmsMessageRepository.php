<?php

namespace App\Repositories;

use App\Enums\SmsMessageStatus;
use App\Models\SmsMessage;

class SmsMessageRepository
{
    public function updateOrCreate(
        int $projectId,
        string $messageId,
        string $to,
        string $message,
        SmsMessageStatus $status
    ) {
        return SmsMessage::updateOrCreate([
            'project_id' => $projectId,
            'message_id' => $messageId,
        ], [
            'to' => $to,
            'message' => $message,
            'status' => $status->value,
        ]);
    }
}
