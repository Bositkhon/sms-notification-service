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
        ?string $name = null,
        ?string $slug = null,
        ?string $apiKey = null,
        ?string $baseUrl = null,
        ?array $credentials = null,
        ?bool $isActive = null
    ) {
        $attributes = [];

        if ($name) {
            $attributes['name'] = $name;
        }

        if ($slug) {
            $attributes['slug'] = $slug;
        }

        if ($apiKey) {
            $attributes['api_key'] = $apiKey;
        }

        if ($baseUrl) {
            $attributes['base_url'] = $baseUrl;
        }

        if ($credentials) {
            $attributes['credentials'] = $credentials;
        }

        if ($isActive) {
            $attributes['is_active'] = $isActive;
        }

        $provider->update($attributes);
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
