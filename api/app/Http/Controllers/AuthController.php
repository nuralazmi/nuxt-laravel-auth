<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Repository\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AuthController extends Controller
{
    public function __construct(public UserRepository $userRepository)
    {
    }

    /**
     * @param UserLoginRequest $request
     * @return JsonResponse
     */
    public function login(UserLoginRequest $request): JsonResponse
    {
        if (Auth::attempt($request->validated())) {
            return response()->json([
                'token' => auth()->user()->createToken('auth_token')->plainTextToken
            ]);
        }

        return response()->json([
            'message' => trans('response.unauthorized'),
        ], ResponseAlias::HTTP_UNAUTHORIZED);

    }

    /**
     * @param UserRegisterRequest $request
     * @return JsonResponse
     */
    public function register(UserRegisterRequest $request): JsonResponse
    {
        $user = $this->userRepository->create($request->validated());
        return response()->json([
            'message' => trans('response.created'),
            'user_id' => $user->id
        ], ResponseAlias::HTTP_CREATED);
    }


    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'ok' => true
        ]);
    }
}
