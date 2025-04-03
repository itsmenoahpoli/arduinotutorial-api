<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\UserService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function __construct(public readonly UserService $userService)
    {}

    public function index(): JsonResponse
    {
        $result = $this->userService->getAll();
        return response()->json($result, Response::HTTP_OK);
    }

    public function store(CreateUserRequest $request): JsonResponse
    {
        $result = $this->userService->create($request->validated());
        return response()->json($result, Response::HTTP_CREATED);
    }

    public function show(string $id): JsonResponse
    {
        $result = $this->userService->find($id);
        return response()->json($result, Response::HTTP_OK);
    }

    public function update(UpdateUserRequest $request, string $id): JsonResponse
    {
        $result = $this->userService->update($request->validated(), $id);
        return response()->json($result, Response::HTTP_OK);
    }

    public function destroy(string $id): JsonResponse
    {
        $this->userService->delete($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
