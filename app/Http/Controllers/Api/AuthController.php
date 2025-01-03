<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SigninRequest;
use App\Services\AuthService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends Controller
{
    public function __construct(public readonly AuthService $authService)
    {}

    public function signin(SigninRequest $request) : JsonResponse
    {
        $result = $this->authService->userAuthenticate($request->validated());

        return response()->json($result, Response::HTTP_OK);
    }

    public function signout() : JsonResponse
    {
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
