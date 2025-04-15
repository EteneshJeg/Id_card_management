<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WoredaResource;
use App\Models\Woreda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WoredaController extends Controller
{
    public function index()
    {
        $woredas = Woreda::all();

        if ($woredas->count() > 0) {
            return WoredaResource::collection($woredas);
        } else {
            return response()->json(['message' => 'No record available'], 200);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'zone' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'All fields are required',
                'errors' => $validator->messages(),
            ], 422);
        }

        $woreda = Woreda::create([
            'name' => $request->name,
            'zone' => $request->zone,
        ]);

        return response()->json([
            'message' => 'Woreda registered successfully.',
            'data' => new WoredaResource($woreda),
        ], 200);
    }

    public function show(Woreda $woreda)
    {
        return response()->json([
            'data' => new WoredaResource($woreda)
        ], 200);
    }

    public function update(Request $request, Woreda $woreda)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'zone' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->messages(),
            ], 422);
        }

        $woreda->update([
            'name' => $request->name,
            'zone' => $request->zone,
        ]);

        return response()->json([
            'message' => 'Woreda updated successfully.',
            'data' => new WoredaResource($woreda)
        ], 200);
    }

    public function destroy(Woreda $woreda)
    {
        $woreda->delete();

        return response()->json([
            'message' => 'Woreda deleted successfully.',
        ], 200);
    }
}
