<?php

namespace App\Repositories;

use App\Models\SmsProvider;

class SmsProviderRepository
{
    public function getAllPaginated(int $perPage = 10)
    {
        return SmsProvider::query()->paginate($perPage);
    }

    public function findById(int $id)
    {
        return SmsProvider::query()->find($id);
    }

    public function delete(SmsProvider $provider)
    {
        return $provider->delete();
    }

    public function findOrfail(int $id)
    {
        return SmsProvider::query()->findOrFail($id);
    }

    public function update(
        SmsProvider $provider,
        string $name,
        string $apiKey,
        string $baseUrl,
        array $credentials,
        bool $isActive
    ) {
        $provider->update([
            'name' => $name,
            'api_key' => $apiKey,
            'base_url' => $baseUrl,
            'credentials' => json_encode($credentials),
            'is_active' => $isActive,
        ]);
    }

    public function create(
        string $name,
        string $slug,
        string $apiKey,
        string $baseUrl,
        array $credentials,
        bool $isActive = true
    ) {
        return SmsProvider::create([
            'name' => $name,
            'slug' => $slug,
            'api_key' => $apiKey,
            'base_url' => $baseUrl,
            'credentials' => json_encode($credentials),
            'is_active' => $isActive
        ]);
    }
}
