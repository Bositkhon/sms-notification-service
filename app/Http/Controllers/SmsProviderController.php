<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSmsProviderRequest;
use App\Http\Requests\UpdateSmsProviderRequest;
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
        return $this->repository->getAllPaginated();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSmsProviderRequest $request)
    {
        $name = $request->input('name');
        $slug = Str::slug($name);
        $apiKey = Crypt::encryptString($request->input('api_key'));

        $smsProvider = $this->repository->create(
            name: $name,
            slug: $slug,
            apiKey: $apiKey,
            baseUrl: $request->input('base_url'),
            credentials: $request->input('credentials')
        );

        return $smsProvider;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->repository->findById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSmsProviderRequest $request, string $id)
    {
        $provider = $this->repository->findOrfail($id);

        $apiKey = $request->input('api_key');
        $baseUrl = $request->input('base_url');
        $credentials = $request->input('credentials');

        $this->repository->update(
            provider: $provider,
            apiKey: $apiKey,
            baseUrl: $baseUrl,
            credentials: $credentials
        );

        return response()->noContent(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $provider = $this->repository->findOrfail($id);

        $this->repository->delete($provider);

        return response()->noContent(201);
    }
}
