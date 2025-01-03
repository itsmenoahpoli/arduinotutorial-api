<?php

namespace App\Http\Controllers\Api\Media;

use App\Http\Controllers\Controller;
use App\Services\Media\MediaVideosService;
use App\Http\Requests\Media\CreateMediaVideoRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class MediaVideosController extends Controller
{
    public function __construct(public readonly MediaVideosService $mediaVideosService)
    {}

    /**
     * Display a listing of the resource.
     */
    public function index() : JsonResponse
    {
        $result = $this->mediaVideosService->getAll();

        return response()->json($result, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateMediaVideoRequest $request)
    {
        $result = $this->mediaVideosService->create($request->validated());

        return response()->json($result, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $result = $this->mediaVideosService->find($id);

        return response()->json($result, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $result = $this->mediaVideosService->update($request->all(), $id);

        return response()->json($result, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->mediaVideosService->delete($id);

        return response()->json($result, Response::HTTP_OK);
    }
}
