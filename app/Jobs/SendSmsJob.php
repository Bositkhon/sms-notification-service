<?php

namespace App\Jobs;

use App\Repositories\ProjectRepository;
use App\Services\Sms\SmsService;
use App\Services\SmsLifecycleService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendSmsJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private readonly int $projectId,
        private readonly string $to,
        private readonly string $message
    ) {
        //
    }

    public function handle(
        ProjectRepository $projectRepository,
        SmsService $smsService,
        SmsLifecycleService $smsLifecycleService
    ): void {
        $project = $projectRepository->getById($this->projectId);

        $result = $smsService->send($project, $this->to, $this->message);

        if ($result->success) {
            $smsLifecycleService->markAsSent($this->projectId, $this->to, $this->message, $result->messageId);
        } else {
            $smsLifecycleService->markAsFailed($this->projectId, $this->to, $this->message, $result->messageId);
        }
    }
}
