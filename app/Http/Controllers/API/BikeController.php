<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\BikeResource;
use App\Models\Bike;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\ModelBike;
use Validator;
use App\Http\Resources\ModelBikeResource;
use Illuminate\Http\JsonResponse;

class BikeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->sendResponse(BikeResource::collection(Bike::all()), 'Bike retrieved successfully.');
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
            'id_user' => 'required',
            'id_model_bike' => 'required',
            'hour' => 'required',
            'km' => 'required',
            'date_add' => 'required',
            'date_update' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        return $this->sendResponse(new BikeResource(Bike::create($request->all())), 'Bike created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $idBike
     * @return JsonResponse
     */
    public function show(int $idBike): JsonResponse
    {
        if (is_null(ModelBike::find($idBike))) {
            return $this->sendError('Bike not found.');
        }
        return $this->sendResponse(new BikeResource(Bike::find($idBike)), 'Bike retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Bike $idBike
     * @return JsonResponse
     */
    public function update(Request $request, Bike $idBike): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'id_user' => 'required',
            'id_model_bike' => 'required',
            'hour' => 'required',
            'km' => 'required',
            'date_add' => 'required',
            'date_update' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $idBike->id_manufacturer = $request['id_manufacturer'];
        $idBike->id_engine = $request['id_engine'];
        $idBike->name = $request['name'];
        $idBike->year_model = $request['year_model'];
        $idBike->save();

        return $this->sendResponse(new BikeResource($idBike), 'Bike updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Bike $bike
     * @return JsonResponse
     */
    public function destroy(Bike $bike): JsonResponse
    {
        $bike->delete();

        return $this->sendResponse([], 'Bike deleted successfully.');
    }
}
