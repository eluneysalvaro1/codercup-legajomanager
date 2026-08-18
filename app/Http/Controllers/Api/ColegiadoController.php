<?php

namespace App\Http\Controllers\Api;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreColegiadoRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class ColegiadoController extends Controller
{
    public function store(StoreColegiadoRequest $request): JsonResponse
    {
        $colegiado = User::create([
            ...$request->validated(),
            'role' => UserRole::Colegiado,
        ]);

        return response()->json(['id' => $colegiado->id], 201);
    }
}
