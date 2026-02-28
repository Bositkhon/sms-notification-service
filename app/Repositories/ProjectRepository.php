<?php

namespace App\Repositories;

use App\Models\Project;

class ProjectRepository
{
    public function create(
        string $name,
        string $description,
        string $apiKey,
        int $smsProviderId
    ): Project {
        return Project::create([
            'name' => $name,
            'description' => $description,
            'api_key' => $apiKey,
            'sms_provider_id' => $smsProviderId
        ]);
    }

    public function update(
        Project $project,
        string $name,
        string $description,
        int $smsProviderId
    ) {
        $project->update([
            'name' => $name,
            'description' => $description,
            'sms_provider_id' => $smsProviderId
        ]);
    }

    public function findOrFail(int $id)
    {
        return Project::findOrFail($id);
    }

    public function delete(Project $project)
    {
        $project->delete();
    }

    public function getAllPaginated(int $perPage = 25)
    {
        return Project::query()->paginate($perPage);
    }

    public function findById(int $id)
    {
        return Project::query()->find($id);
    }

    public function getById(int $id)
    {
        return Project::query()->find($id);
    }
}
