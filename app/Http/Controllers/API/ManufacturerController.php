<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Manufacturer;
use Illuminate\Http\Response;
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
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $manufacturer = Manufacturer::create($input);

        return $this->sendResponse(new ManufacturerResource($manufacturer), 'Manufacturer created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $manufacturer = Manufacturer::find($id);

        if (is_null($manufacturer)) {
            return $this->sendError('Manufacturer not found.');
        }
        return $this->sendResponse(new ManufacturerResource($manufacturer), 'Manufacturer retrieved successfully.');
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
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $manufacturer->name = $input['name'];
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
