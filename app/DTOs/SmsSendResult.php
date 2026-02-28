<?php

namespace App\DTOs;

readonly class SmsSendResult
{
    public function __construct(
        public bool $success,
        public ?string $messageId = null,
        public ?string $errorMessage = null,
        public array $rawResponse = [],
    ) {}

    public static function success(string $messageId, array $rawResponse = []): self
    {
        return new self(true, $messageId, null, $rawResponse);
    }

    public static function failure(string $errorMessage, array $rawResponse = []): self
    {
        return new self(false, null, $errorMessage, $rawResponse);
    }
}
