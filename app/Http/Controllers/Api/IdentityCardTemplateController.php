<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\IdentityCardTemplatesResource;
use App\Models\IdentityCardTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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
            'file' => 'required|file|mimes:pdf,doc,docx|max:2048', // Changed to file type
            'sample_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // Changed to file type
            'status' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->messages(),
            ], 422);
        }

        // Handle main file upload
        $filePath = $request->file('file')->store('card_templates', 'public');
        
        // Handle sample file upload if exists
        $sampleFilePath = null;
        if ($request->hasFile('sample_file')) {
            $sampleFilePath = $request->file('sample_file')->store('sample_templates', 'public');
        }

        $template = IdentityCardTemplate::create([
            'type' => $request->type,
            'file' => $filePath,
            'sample_file' => $sampleFilePath,
            'status' => $request->status,
        ]);

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
            'file' => 'sometimes|file|mimes:pdf,doc,docx|max:2048', // Changed to optional file
            'sample_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // Changed to file type
            'status' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->messages(),
            ], 422);
        }

        $updateData = ['type' => $request->type, 'status' => $request->status];

        // Handle main file update
        if ($request->hasFile('file')) {
            // Delete old file
            Storage::disk('public')->delete($identityCardTemplate->file);
            $updateData['file'] = $request->file('file')->store('card_templates', 'public');
        }

        // Handle sample file update
        if ($request->hasFile('sample_file')) {
            // Delete old sample file if exists
            if ($identityCardTemplate->sample_file) {
                Storage::disk('public')->delete($identityCardTemplate->sample_file);
            }
            $updateData['sample_file'] = $request->file('sample_file')->store('sample_templates', 'public');
        } elseif ($request->has('sample_file') && $request->sample_file === null) {
            // Handle sample file removal
            if ($identityCardTemplate->sample_file) {
                Storage::disk('public')->delete($identityCardTemplate->sample_file);
            }
            $updateData['sample_file'] = null;
        }

        $identityCardTemplate->update($updateData);

        return response()->json([
            'message' => 'Identity Card Template updated successfully.',
            'data' => new IdentityCardTemplatesResource($identityCardTemplate)
        ], 200);
    }

    public function destroy(IdentityCardTemplate $identityCardTemplate) 
    {
        // Delete associated files
        Storage::disk('public')->delete([
            $identityCardTemplate->file,
            $identityCardTemplate->sample_file
        ]);

        $identityCardTemplate->delete();
        return response()->json([
            'message' => 'Identity Card Template deleted successfully.'
        ], 200);
    }
}