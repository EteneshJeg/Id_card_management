<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JobTitleCategoriesResource;
use App\Models\JobTitleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobTitleCategoriesController extends Controller
{
    public function index() 
    {
        $jobTitleCategories = JobTitleCategory::all();

        if ($jobTitleCategories->isNotEmpty()) {
            return JobTitleCategoriesResource::collection($jobTitleCategories);
        }

        return response()->json(['message' => 'No record available'], 200);
    }

    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'parent' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->messages(),
            ], 422);
        }

        $jobTitleCategory = JobTitleCategory::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'parent' => $request->input('parent'),
        ]);

        return response()->json([
            'message' => 'Job title category registered successfully.',
            'data' => new JobTitleCategoriesResource($jobTitleCategory),
        ], 201);
    }

    public function show(JobTitleCategory $jobTitleCategory) 
    {
        return new JobTitleCategoriesResource($jobTitleCategory);
    }

    public function update(Request $request, JobTitleCategory $jobTitleCategory) 
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'parent' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->messages(),
            ], 422);
        }

        $jobTitleCategory->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'parent' => $request->input('parent'),
        ]);

        return response()->json([
            'message' => 'Job title category updated successfully.',
            'data' => new JobTitleCategoriesResource($jobTitleCategory),
        ], 200);
    }

    public function destroy(JobTitleCategory $jobTitleCategory) 
    {
        $jobTitleCategory->delete();

        return response()->json([
            'message' => 'Job title category deleted successfully.',
        ], 200);
    }
}
