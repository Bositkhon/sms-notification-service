<?php

namespace App\Models;

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

    protected $fillable = [
        'name',
        'description',
        'api_key',
        'sms_provider_id'
    ];

    public function smsProvider()
    {
        return $this->belongsTo(SmsProvider::class, 'sms_provider_id');
    }
}
