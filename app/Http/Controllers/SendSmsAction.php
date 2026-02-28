<?php

namespace App\Http\Controllers;

use App\Http\Middleware\ApiKeyMiddleware;
use App\Http\Requests\SendSmsRequest;
use App\Jobs\SendSmsJob;
use App\Services\Sms\SmsService;
use Symfony\Component\HttpFoundation\Response;

class SendSmsAction extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(SendSmsRequest $request, SmsService $smsService)
    {
        /** @var \App\Models\Project $project */
        $project = $request->attributes->get(ApiKeyMiddleware::PROJECT_ATTRIBUTE);

        dispatch(new SendSmsJob($project->id, $request->input('to'), $request->input('message')));

        return response()->noContent(Response::HTTP_OK);
    }
}
