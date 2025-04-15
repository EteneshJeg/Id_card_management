<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RegionResource;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegionsController extends Controller
{
    public function index()
    {
        $regions = Region::all();

        if ($regions->count() > 0) {
            return RegionResource::collection($regions);
        } else {
            return response()->json(['message' => 'No record available'], 200);
        }
    }

    public function store(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Create region
        $region = Region::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return response()->json([
            'message' => 'Region registered successfully.',
            'data' => new RegionResource($region)
        ], 201);
    }

    public function show(Region $region)
    {
        return new RegionResource($region);
    }

    public function update(Request $request, Region $region)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Update region
        $region->update([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return response()->json([
            'message' => 'Region updated successfully.',
            'data' => new RegionResource($region)
        ], 200);
    }

    public function destroy(Region $region)
    {
        $region->delete();

        return response()->json([
            'message' => 'Region deleted successfully.',
        ], 200);
    }
}
