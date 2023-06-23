<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Engine;
use Validator;
use App\Http\Resources\EngineResource;
use Illuminate\Http\JsonResponse;

class EngineController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->sendResponse(EngineResource::collection(Engine::all()), 'Engine retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'capacity' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        return $this->sendResponse(new EngineResource(Engine::create($request->all())), 'Engine created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $idEngine
     * @return JsonResponse
     */
    public function show(int $idEngine): JsonResponse
    {
        if (is_null(Engine::find($idEngine))) {
            return $this->sendError('Engine not found.');
        }
        return $this->sendResponse(new EngineResource(Engine::find($idEngine)), 'Engine retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Engine $engine
     * @return JsonResponse
     */
    public function update(Request $request, Engine $engine): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $engine->capacity = $request['capacity'];
        $engine->save();

        return $this->sendResponse(new EngineResource($engine), 'Engine updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Engine $engine
     * @return JsonResponse
     */
    public function destroy(Engine $engine): JsonResponse
    {
        $engine->delete();

        return $this->sendResponse([], 'Engine deleted successfully.');
    }
}
