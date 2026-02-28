<?php

namespace App\Http\Requests;

use App\Http\Middleware\ApiKeyMiddleware;
use Illuminate\Foundation\Http\FormRequest;

class SendSmsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->attributes->has(ApiKeyMiddleware::PROJECT_ATTRIBUTE);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'to' => ['required', 'array'],
            'to.*' => ['required', 'string', 'regex:/^\+998(?:[35789]\d)\d{7}$/'],
            'message' => ['required', 'string'],
        ];
    }
}
