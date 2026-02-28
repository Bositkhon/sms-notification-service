<?php

namespace App\Http\Middleware;

use App\Models\Project;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyMiddleware
{
    public const PROJECT_ATTRIBUTE = 'project';

    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('X-Api-Key') ?? $request->query('api_key');

        if (empty($apiKey)) {
            return response()->json(['message' => 'API key is missing'], 400);
        }

        $project = Project::where('api_key', $apiKey)->first();

        if ($project === null) {
            return response()->json(['message' => 'API key is missing'], 400);
        }

        $request->attributes->set(self::PROJECT_ATTRIBUTE, $project);

        return $next($request);
    }
}
