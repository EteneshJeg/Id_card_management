<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\IdentityCardTemplate;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class IdentityCardTemplatesController extends Controller
{
    /**
     * Display a listing of identity card templates
     */
    public function index(): JsonResponse
    {
        $templates = IdentityCardTemplate::paginate(25);
        return response()->json($templates);
    }

    /**
     * Store a new identity card template
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $data = $this->getData($request);
            $template = IdentityCardTemplate::create($data);

            return response()->json($template, 201);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Display specific template
     */
    public function show($id): JsonResponse
    {
        $template = IdentityCardTemplate::findOrFail($id);
        return response()->json($template);
    }

    /**
     * Update a template
     */
    public function update($id, Request $request): JsonResponse
    {
        try {
            $template = IdentityCardTemplate::findOrFail($id);
            $data = $this->getData($request);
            $template->update($data);

            return response()->json($template);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Delete a template
     */
    public function destroy($id): JsonResponse
    {
        try {
            $template = IdentityCardTemplate::findOrFail($id);
            $template->delete();

            return response()->json(null, 204);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Delete failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Validation and data processing
     */
    protected function getData(Request $request): array
    {
        $rules = [
            'type' => 'required|string|min:1',
            'file' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'sample_file' => 'nullable|string',
            'status' => 'required|string|in:active,inactive'
        ];

        $data = $request->validate($rules);

        // Handle file upload
        if ($request->hasFile('file')) {
            $data['file'] = $this->storeFile($request->file('file'));
        }

        return $data;
    }

    /**
     * Store uploaded file
     */
    protected function storeFile($file): string
    {
        return Storage::url(
            $file->store('public/templates')
        );
    }
}