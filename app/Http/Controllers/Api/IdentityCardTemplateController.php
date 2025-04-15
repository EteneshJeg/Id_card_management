<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\IdentityCardTemplatesResource;
use App\Models\IdentityCardTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IdentityCardTemplateController extends Controller
{
    public function index() 
    {
        $identityCardTemplate = IdentityCardTemplate::get();
        if($identityCardTemplate->count() > 0) 
        {
            return IdentityCardTemplatesResource::collection($identityCardTemplate);
        }
        else
        {
            return response()->json([
                'message' => 'No record available'
            ], 200);
        }

    }
    public function store(Request $request) 
    {
            $validator = Validator::make($request->all(), [
            'type' => 'required|string|max:50',
            'file' => 'required|string|max:255',
            'sample_file' => 'nullable|string|max:255',
            'status' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'error' => $validator->messages(),
            ], 422);
        }

        $template = IdentityCardTemplate::create($request->all());

        return response()->json([
            'message' => 'Identity Card Template created successfully.',
            'data' => new IdentityCardTemplatesResource($template)
        ], 200);

    }

    public function show(IdentityCardTemplate $identityCardTemplate) 
    {
        return new IdentityCardTemplatesResource($identityCardTemplate);
    }

    public function update(Request $request, IdentityCardTemplate $identityCardTemplate) 
    {
            $validator = Validator::make($request->all(), [
            'type' => 'required|string|max:50',
            'file' => 'required|string|max:255',
            'sample_file' => 'nullable|string|max:255',
            'status' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'error' => $validator->messages(),
            ], 422);
        }

        $identityCardTemplate->update($request->all());

        return response()->json([
            'message' => 'Identity Card Template updated successfully.',
            'data' => new IdentityCardTemplatesResource($identityCardTemplate)
        ], 200);
    }

    public function destroy(IdentityCardTemplate $identityCardTemplate) 
    {
        $identityCardTemplate->delete();
        return response()->json([
            'message' => 'Identity Card Template deleted successfully.'
        ], 200);
    }
}
