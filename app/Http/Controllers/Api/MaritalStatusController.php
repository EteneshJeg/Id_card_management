<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MaritalStatusResource;
use App\Models\MaritalStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class MaritalStatusController extends Controller
{
    public function index() 
    {
        $maritalStatus = MaritalStatus::get();
        if($maritalStatus->count() > 0)
        {
            return MaritalStatusResource::collection($maritalStatus);

        }
        else 
        {
            return response()->json(['message' => 'No record available'], 200);
        }
    }
    public function store(Request $request) 
    {
        // 1. Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        // 2. Create the employee record
        if($validator->fails()){
            return response()->json([
                'message' => 'All fields are required',
                'error' => $validator->messages(),
            ],422);
        }

                    
        // $maritalStatus = MaritalStatus::create([
        //     'name' => 'required|string|max:255',
        //     'description' => 'required|string|max:255',

        // ]);

        $maritalStatus = MaritalStatus::create([
            'name' => $request->name,
            'description' => $request->description,

        ]);


        // 3. Return JSON response
        return response()->json([
            'message' => 'MaritalStatus registered successfully.',
            'data' => new MaritalStatusResource($maritalStatus)
        ], 200);
    }

    public function show(MaritalStatus $maritalStatus) 
    {
        return new MaritalStatusResource($maritalStatus);

    }
    public function update(Request $request,MaritalStatus $maritalStatus) 
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);


        // 2. Create the employee record
        if($validator->fails()){
            return response()->json([
                'message' => 'All fields are required',
                'error' => $validator->messages(),
            ],422);
        }

        $maritalStatus->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response() ->json([
            'message' => 'MaritalStatus updated Successfully',
            'date' => new MaritalStatusResource($maritalStatus)
        ],200);
    }
    public function destroy(MaritalStatus $maritalStatus) 
    {
        $maritalStatus->delete();
        return response() ->json([
            'message' => 'MaritalStatus Deleted Successfully',
        ],200);

    }
    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids');

        if (!is_array($ids) || empty($ids)) {
            return response()->json(['message' => 'No IDs provided'], 400);
        }

        MaritalStatus::whereIn('id', $ids)->delete();

        return response()->json(['message' => 'Selected marital statuses deleted successfully'], 200);
    }

}