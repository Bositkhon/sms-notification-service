<?php

namespace App\Models;

use App\Enums\SmsProviderSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property SmsProviderSlug $slug
 */
class SmsProvider extends Model
{
    /** @use HasFactory<\Database\Factories\SmsProviderFactory> */
    use HasFactory;

    protected $casts = [
        'slug' => SmsProviderSlug::class
    ];

    public function projects()
    {
        return $this->hasMany(Project::class, 'sms_provider_id');
    }
}
