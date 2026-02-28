<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSmsProviderRequest;
use App\Http\Requests\UpdateSmsProviderRequest;
use App\Http\Resources\SmsProviderResource;
use App\Repositories\SmsProviderRepository;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class SmsProviderController extends Controller
{
    public function __construct(
        private readonly SmsProviderRepository $repository
    ) {
    }

    public function index()
    {
        $smsProviders = $this->repository->getAllPaginated();

        return SmsProviderResource::collection($smsProviders);
    }

    public function store(StoreSmsProviderRequest $request)
    {
        $name = $request->input('name');
        $apiKey = $request->input('api_key');
        $baseUrl = $request->input('base_url');
        $credentials = $request->input('credentials');

        $slug = Str::slug($name);
        $encryptedApiKey = Crypt::encryptString($apiKey);

        $smsProvider = $this->repository->create(
            name: $name,
            slug: $slug,
            apiKey: $encryptedApiKey,
            baseUrl: $baseUrl,
            credentials: $credentials
        );

        return SmsProviderResource::make($smsProvider);
    }

    public function show(string $id)
    {
        $project = $this->repository->findOrfail($id);

        return SmsProviderResource::make($project);
    }

    public function update(UpdateSmsProviderRequest $request, string $id)
    {
        $provider = $this->repository->findOrfail($id);

        $name = $request->input('name');
        $apiKey = $request->input('api_key');
        $baseUrl = $request->input('base_url');
        $credentials = $request->input('credentials');
        $isActive = $request->input('is_active');

        $encryptedApiKey = Crypt::encryptString($apiKey);

        $this->repository->update(
            provider: $provider,
            name: $name,
            apiKey: $encryptedApiKey,
            baseUrl: $baseUrl,
            credentials: $credentials,
            isActive: $isActive
        );

        return SmsProviderResource::make($provider);
    }

    public function destroy(string $id)
    {
        $provider = $this->repository->findOrfail($id);

        $this->repository->delete($provider);

        return response()->noContent(201);
    }
}
