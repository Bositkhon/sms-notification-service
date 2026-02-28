<?php

namespace App\Services\Sms;

use App\DTOs\SmsSendResult;
use App\Factories\SmsProviderFactory;
use App\Models\Project;
use GuzzleHttp\Exception\BadResponseException;

class SmsService
{
    public function __construct(
        private readonly SmsProviderFactory $smsProviderFactory,
    ) {

    }
    public function send(Project $project, string $to, string $message)
    {
        $provider = $this->smsProviderFactory->forProject($project);

        try {
            $result = $provider->send($to, $message);
        } catch (BadResponseException $exception) {
            $result = new SmsSendResult(
                success: false,
                errorMessage: $exception->getMessage(),
                rawResponse: $exception->getResponse()?->getBody()->getContents()
            );
        }

        return $result;
    }
}
