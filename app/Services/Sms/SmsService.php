<?php

namespace App\Services\Sms;

use App\Factories\SmsProviderFactory;
use App\Models\Project;

class SmsService
{
    public function __construct(
        private readonly SmsProviderFactory $smsProviderFactory,
    ) {

    }
    public function send(Project $project, string $to, string $message)
    {
        $provider = $this->smsProviderFactory->forProject($project);
        
        $result = $provider->send($to, $message);

        return $result;
    }
}
