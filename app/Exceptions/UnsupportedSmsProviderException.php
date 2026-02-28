<?php

namespace App\Exceptions;

use App\Enums\SmsProviderSlug;
use RuntimeException;

class UnsupportedSmsProviderException extends RuntimeException
{
    private $messageTemplate = 'Unsupported SMS provider %s. Supported: %s';

    public function __construct(SmsProviderSlug $slug, array $supported)
    {
        $this->message = sprintf($this->messageTemplate, $slug->value, json_encode($supported));
    }
}
