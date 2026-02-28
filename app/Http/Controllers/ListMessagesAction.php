<?php

namespace App\Http\Controllers;

use App\Repositories\SmsMessageRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListMessagesAction extends Controller
{
    /**
     * List SMS messages with optional filters (status, to, created_from, created_to) and pagination.
     */
    public function __invoke(Request $request, SmsMessageRepository $repository): JsonResponse
    {
        $queryParams = [
            'status' => $request->query('status'),
            'to' => $request->query('to'),
            'created_from' => $request->query('created_from'),
            'created_to' => $request->query('created_to'),
            'per_page' => min((int) $request->query('per_page', 15), 100) ?: 15,
        ];

        $paginated = $repository->getAllPaginated(
            array_filter($queryParams, fn ($v) => $v !== null && $v !== ''),
            $queryParams['per_page']
        );

        return response()->json([
            'data' => $paginated->items(),
            'meta' => [
                'current_page' => $paginated->currentPage(),
                'last_page' => $paginated->lastPage(),
                'per_page' => $paginated->perPage(),
                'total' => $paginated->total(),
                'from' => $paginated->firstItem(),
                'to' => $paginated->lastItem(),
            ],
        ]);
    }
}
