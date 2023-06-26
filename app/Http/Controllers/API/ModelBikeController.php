<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\ModelBike;
use Validator;
use App\Http\Resources\ModelBikeResource;
use Illuminate\Http\JsonResponse;

class ModelBikeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->sendResponse(ModelBikeResource::collection(ModelBike::all()), 'Model bike retrieved successfully.');
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
            'id_manufacturer' => 'required',
            'id_engine' => 'required',
            'name' => 'required',
            'year_model' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        return $this->sendResponse(new ModelBikeResource(ModelBike::create($request->all())), 'Model bike created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $idModelBike
     * @return JsonResponse
     */
    public function show(int $idModelBike): JsonResponse
    {
        if (is_null(ModelBike::find($idModelBike))) {
            return $this->sendError('Model bike not found.');
        }
        return $this->sendResponse(new ModelBikeResource(ModelBike::find($idModelBike)), 'Model bike retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param ModelBike $idModelBike
     * @return JsonResponse
     */
    public function update(Request $request, ModelBike $idModelBike): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'id_manufacturer' => 'required',
            'id_engine' => 'required',
            'name' => 'required',
            'year_model' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $idModelBike->id_manufacturer = $request['id_manufacturer'];
        $idModelBike->id_engine = $request['id_engine'];
        $idModelBike->name = $request['name'];
        $idModelBike->year_model = $request['year_model'];
        $idModelBike->save();

        return $this->sendResponse(new ModelBikeResource($idModelBike), 'Model bike updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ModelBike $modelBike
     * @return JsonResponse
     */
    public function destroy(ModelBike $modelBike): JsonResponse
    {
        $modelBike->delete();

        return $this->sendResponse([], 'Model bike deleted successfully.');
    }
}
