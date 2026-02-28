<?php

namespace App\Repositories;

use App\Enums\SmsMessageStatus;
use App\Models\SmsMessage;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SmsMessageRepository
{
    public function getAllPaginated(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = SmsMessage::query()->orderByDesc('created_at');

        if (!empty($filters['status'])) {
            $status = $filters['status'];
            if (SmsMessageStatus::tryFrom($status) !== null) {
                $query->where('status', $status);
            }
        }

        if (!empty($filters['to'])) {
            $query->where('to', 'like', '%' . $filters['to'] . '%');
        }

        if (!empty($filters['created_from'])) {
            $createdFrom = Carbon::parse($filters['created_from']);
            $query->where('created_at', '>=', $createdFrom);
        }

        if (!empty($filters['created_to'])) {
            $createdTo = Carbon::parse($filters['created_to']);
            $query->where('created_at', '<=', $createdTo);
        }

        return $query->paginate($filters['per_page'] ?? $perPage);
    }

    public function updateOrCreate(
        int $projectId,
        string $messageId,
        string $to,
        string $message,
        SmsMessageStatus $status
    ) {
        return SmsMessage::updateOrCreate([
            'project_id' => $projectId,
            'message_id' => $messageId,
        ], [
            'to' => $to,
            'message' => $message,
            'status' => $status->value,
        ]);
    }
}
