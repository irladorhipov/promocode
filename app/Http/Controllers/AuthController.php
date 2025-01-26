<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * @param SignupRequest $request
     * @param AuthService $authService
     * @return JsonResponse
     */
    public function signup(SignupRequest $request, AuthService $authService): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $user = $authService->signup($validatedData);

            return response()->json(['data' => $user], Response::HTTP_CREATED);
        } catch (\Throwable $e) {
            Log::error(sprintf('User creation failed: %s', $e->getMessage()));

            return response()->json(['error' => 'User signup failed. Please try again later.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param LoginRequest $request
     * @param AuthService $authService
     * @return JsonResponse
     * @throws \Exception
     */
    public function login(LoginRequest $request, AuthService $authService): JsonResponse
    {
        $validatedData = $request->validated();

        $data = $authService->login($validatedData['email'], $validatedData['password']);

        return response()->json($data)
            ->cookie('jwt', $data['token'], config('jwt.token_expiration'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        return response()->json(['message' => 'Successfully logged out'])
            ->cookie('jwt', null, -1);
    }
}
