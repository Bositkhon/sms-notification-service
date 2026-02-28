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
        private readonly array $to,
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

        foreach ($this->to as $phoneNumber) {
            $result = $smsService->send($project, $phoneNumber, $this->message);

            if ($result->success) {
                $smsLifecycleService->markAsSent($this->projectId, $phoneNumber, $this->message, $result->messageId);
            } else {
                $smsLifecycleService->markAsFailed($this->projectId, $phoneNumber, $this->message, $result->messageId);
            }
        }
    }
}
