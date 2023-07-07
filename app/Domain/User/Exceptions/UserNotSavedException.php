<?php

namespace App\Domain\User\Exceptions;

use App\Domain\Shared\Exception\NotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserNotSavedException extends NotFoundException
{
    public function render(Request $request): JsonResponse
    {
        return response()->json([
            'message' => 'User not saved : '.$this->getMessage(),
        ], 500);
    }
}
