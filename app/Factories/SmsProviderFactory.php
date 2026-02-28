<?php

namespace App\Factories;

use App\Contracts\SmsProviderInterface;
use App\Enums\SmsProviderSlug;
use App\Models\Project;
use App\Services\Sms\EskizSmsService;
use App\Services\Sms\PlaymobileSmsService;
use App\Services\Sms\TwilioSmsService;
use App\Exceptions\UnsupportedSmsProviderException;

class SmsProviderFactory
{
    private function make(SmsProviderSlug $slug): SmsProviderInterface
    {
        return match ($slug) {
            SmsProviderSlug::ESKIZ => app(EskizSmsService::class),
            SmsProviderSlug::PLAYMOBILE => app(PlaymobileSmsService::class),
            SmsProviderSlug::TWILIO => app(TwilioSmsService::class),
            default => throw new UnsupportedSmsProviderException(slug: $slug, supported: SmsProviderSlug::values())
        };
    }

    public function forProject(Project $project): SmsProviderInterface
    {
        $provider = $project->smsProvider;

        return $this->make($provider->slug);
    }
}
