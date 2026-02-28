<?php

namespace App\Models;

use App\Enums\SmsProviderSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @property SmsProvider $smsProvider
 */
class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    public function smsProvider()
    {
        return $this->belongsTo(SmsProviderSlug::class, 'sms_provider_id');
    }
}
