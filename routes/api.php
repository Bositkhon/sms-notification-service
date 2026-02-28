<?php

use App\Http\Controllers\ListMessagesAction;
use App\Http\Controllers\SendSmsAction;
use Illuminate\Support\Facades\Route;

Route::get('test', function () {
    return 'test';
});

Route::post('sms/send', SendSmsAction::class)
    ->middleware('api_key');

Route::get('sms/messages', ListMessagesAction::class)
    ->middleware('api_key');
