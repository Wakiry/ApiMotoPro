<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Manufacturer;
use Validator;
use App\Http\Resources\ManufacturerResource;
use Illuminate\Http\JsonResponse;

class ManufacturerController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $manufacturers = Manufacturer::all();
        return $this->sendResponse(ManufacturerResource::collection($manufacturers), 'Manufacturers retrieved successfully.');
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
     * @param int $idManufacturer
     * @return JsonResponse
     */
    public function show(int $idManufacturer): JsonResponse
    {
        if (is_null(Manufacturer::find($idManufacturer))) {
            return $this->sendError('Manufacturer not found.');
        }
        return $this->sendResponse(new ManufacturerResource(Manufacturer::find($idManufacturer)), 'Manufacturer retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Manufacturer $manufacturer
     * @return JsonResponse
     */
    public function update(Request $request, Manufacturer $manufacturer): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $manufacturer->name = $request['name'];
        $manufacturer->save();

        return $this->sendResponse(new ManufacturerResource($manufacturer), 'Manufacturer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Manufacturer $manufacturer
     * @return JsonResponse
     */
    public function destroy(Manufacturer $manufacturer): JsonResponse
    {
        $manufacturer->delete();

        return $this->sendResponse([], 'Manufacturer deleted successfully.');
    }
}
