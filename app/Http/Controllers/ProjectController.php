<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Repositories\ProjectRepository;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function __construct(private readonly ProjectRepository $repository)
    {

    }

    public function index()
    {
        return ProjectResource::collection($this->repository->getAllPaginated());
    }

    public function store(StoreProjectRequest $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $apiKey = Str::random(32);
        $smsProviderId = $request->input('sms_provider_id');

        $project = $this->repository->create(
            name: $name,
            description: $description,
            apiKey: $apiKey,
            smsProviderId:$smsProviderId
        );

        return ProjectResource::make($project);
    }

    public function show(int $id)
    {
        $project = $this->repository->findOrFail($id);

        return ProjectResource::make($project);
    }

    public function update(UpdateProjectRequest $request, string $id)
    {
        $project = $this->repository->findOrFail($id);

        $name = $request->input('name');
        $description = $request->input('description');
        $smsProviderId = $request->input('sms_provider_id');

        $this->repository->update(
            project: $project,
            name: $name,
            description: $description,
            smsProviderId: $smsProviderId
        );

        return ProjectResource::make($project);
    }

    public function destroy(string $id)
    {
        $project = $this->repository->findOrfail($id);

        $this->repository->delete($project);

        return response()->noContent();
    }
}
