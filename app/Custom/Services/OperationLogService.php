<?php

namespace App\Custom\Services;

// use Illuminate\Http\Request;
// use App\Models\User;

class OperationLogService
{
    public function __construct(
        // private Request $request,
        // private User $user,
    ) {}

    public function create($model, $operation)
    {
        auth()->user()->logs()->create([
            'table' => $model->getTable(),
            'operation' => $operation,
            'data' => $model->toJson(),
            'ip' => request()->ip(),
        ]);
    }
}
