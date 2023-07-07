<?php

namespace App\Domain\User\Exceptions;

use App\Domain\Shared\Exception\NotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserNotFoundException extends NotFoundException
{
    public function render(Request $request): JsonResponse
    {
        return response()->json([
            'message' => 'User not found',
        ], 404);
    }
}
