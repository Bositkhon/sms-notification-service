<?php

namespace App\Repositories;

use App\Enums\SmsProviderSlug;
use App\Models\Project;

class ProjectRepository
{
    public function create(
        string $name,
        string $description,
        SmsProviderSlug $provider
    ): Project {
        return Project::create([
            'name' => $name,
            'description' => $description,
            'sms_provider' => $provider->value
        ]);
    }
}
