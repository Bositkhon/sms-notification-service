<?php

use App\Http\Controllers\ListMessagesAction;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SendSmsAction;
use App\Http\Controllers\SmsProviderController;
use Illuminate\Support\Facades\Route;

Route::apiResource('projects', ProjectController::class);

Route::apiResource('sms-providers', SmsProviderController::class);

Route::post('sms/send', SendSmsAction::class)
    ->middleware('api_key');

Route::get('sms/messages', ListMessagesAction::class)
    ->middleware('api_key');
