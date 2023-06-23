<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\EngineType;
use Validator;
use App\Http\Resources\EngineTypeResource;
use Illuminate\Http\JsonResponse;

class EngineTypeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->sendResponse(EngineTypeResource::collection(EngineType::all()), 'Engine type retrieved successfully.');
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
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        return $this->sendResponse(new ManufacturerResource(Manufacturer::create($request->all())), 'Manufacturer created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $idEngineType
     * @return JsonResponse
     */
    public function show(int $idEngineType): JsonResponse
    {
        if (is_null(EngineType::find($idEngineType))) {
            return $this->sendError('Engine type not found.');
        }
        return $this->sendResponse(new EngineTypeResource(EngineType::find($idEngineType)), 'Engine type retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param EngineType $engineType
     * @return JsonResponse
     */
    public function update(Request $request, EngineType $engineType): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $engineType->name = $request['name'];
        $engineType->save();

        return $this->sendResponse(new EngineTypeResource($engineType), 'Engine type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param EngineType $engineType
     * @return JsonResponse
     */
    public function destroy(EngineType $engineType): JsonResponse
    {
        $engineType->delete();

        return $this->sendResponse([], 'Engine type deleted successfully.');
    }
}
