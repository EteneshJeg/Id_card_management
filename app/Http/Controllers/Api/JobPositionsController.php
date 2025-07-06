<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JobPositionResource;
use App\Models\JobPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobPositionsController extends Controller
{
    public function index() 
    {
        $jobPositions = JobPosition::all();

        if ($jobPositions->count() > 0) {
            return JobPositionResource::collection($jobPositions);
        } else {
            return response()->json(['message' => 'No record available'], 200);
        }
    }

    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'organization_unit_id' => 'required|exists:organization_units,id',
            'job_title_category_id' => 'required|exists:job_title_categories,id',
            'job_description' => 'required|string|max:255',
            'position_code' => 'nullable|string|max:255',
            'status' => 'required|string|max:255|in:active,inactive,pending' 
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();
        $jobPosition = JobPosition::create($validated);

        return response()->json([
            'message' => 'Job position registered successfully.',
            'data' => new JobPositionResource($jobPosition),
        ], 201);
    }

    public function show(JobPosition $jobPosition) 
    {
        return new JobPositionResource($jobPosition);
    }

    public function update(Request $request, JobPosition $jobPosition) 
    {
        $validator = Validator::make($request->all(), [
            'organization_unit_id' => 'required|exists:organization_units,id',
            'job_title_category_id' => 'required|exists:job_title_categories,id',
            'job_description' => 'required|string|max:255',
            'position_code' => 'nullable|string|max:255',
            'status' => 'required|string|max:255|in:active,inactive,pending' 
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }


        $validated = $validator->validated();
        $jobPosition->update($validated);

        return response()->json([
            'message' => 'Job position updated successfully.',
            'data' => new JobPositionResource($jobPosition),
        ], 200);
    }

    public function destroy(JobPosition $jobPosition) 
    {
        $jobPosition->delete();

        return response()->json([
            'message' => 'Job position deleted successfully.',
        ], 200);
    }
}
