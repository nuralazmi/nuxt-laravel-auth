<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        $user = auth()->user();

        return response()->json([
            'user' => $user
        ]);
    }
}
