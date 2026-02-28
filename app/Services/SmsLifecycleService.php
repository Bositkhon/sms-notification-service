<?php

namespace App\Services;

use App\DTOs\SmsSendResult;
use App\Enums\SmsMessageStatus;
use App\Models\Project;
use App\Repositories\SmsMessageRepository;

class SmsLifecycleService
{
    public function __construct(
        private readonly SmsMessageRepository $repository
    ) {

    }

    public function markAsPending(int $projectId, string $to, string $message, string $messageId)
    {
        $this->repository->updateOrCreate($projectId, $messageId, $to, $message, SmsMessageStatus::PENDING);
    }

    public function markAsSent(int $projectId, string $to, string $message, string $messageId)
    {
        $this->repository->updateOrCreate($projectId, $messageId, $to, $message, SmsMessageStatus::SENT);
    }

    public function markAsFailed(int $projectId, string $to, string $message, string $messageId)
    {
        $this->repository->updateOrCreate($projectId, $messageId, $to, $message, SmsMessageStatus::FAILED);
    }
}
