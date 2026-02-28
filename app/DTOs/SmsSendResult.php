<?php

namespace App\DTOs;

readonly class SmsSendResult
{
    public function __construct(
        public bool $success,
        public ?string $messageId = null,
        public ?string $errorMessage = null,
        public ?string $rawResponse = '',
    ) {}

    public static function success(string $messageId, string $rawResponse = ''): self
    {
        return new self(true, $messageId, null, $rawResponse);
    }

    public static function failure(string $errorMessage, string $rawResponse = ''): self
    {
        return new self(false, null, $errorMessage, $rawResponse);
    }
}
