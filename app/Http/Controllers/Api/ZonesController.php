<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ZoneResource;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ZonesController extends Controller
{
    public function index()
    {
        $zones = Zone::all();

        if ($zones->count() > 0) {
            return ZoneResource::collection($zones);
        } else {
            return response()->json(['message' => 'No record available'], 200);
        }
    }

    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'region' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Create zone
        $zone = Zone::create([
            'name' => $request->name,
            'region' => $request->region,
        ]);

        return response()->json([
            'message' => 'Zone registered successfully.',
            'data' => new ZoneResource($zone)
        ], 201);
    }

    public function show(Zone $zone)
    {
        return new ZoneResource($zone);
    }

    public function update(Request $request, Zone $zone)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'region' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Update zone
        $zone->update([
            'name' => $request->name,
            'region' => $request->region,
        ]);

        return response()->json([
            'message' => 'Zone updated successfully.',
            'data' => new ZoneResource($zone)
        ], 200);
    }

    public function destroy(Zone $zone)
    {
        $zone->delete();

        return response()->json([
            'message' => 'Zone deleted successfully.',
        ], 200);
    }
}
