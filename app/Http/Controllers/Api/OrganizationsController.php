<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrganizationResource;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class OrganizationsController extends Controller
{
    public function index() 
    {
        $organizations = Organization::get();
        if($organizations->count() > 0)
        {
            return OrganizationResource::collection($organizations);

        }
        else 
        {
            return response()->json(['message' => 'No record available'], 200);
        }
    }
    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'en_name' => 'required|string|max:255',
            'motto' => 'required|string|max:255',
            'mission' => 'required|string|max:255',
            'vision' => 'required|string|max:255',
            'core_value' => 'required|string|max:255',
           'logo' => 'nullable|image|mimes:jpg,jpeg,png,ico,gif,svg,webp|max:2048',
            'address' => 'nullable|string|max:255',
            'website' => 'nullable|string',
            'email' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'fax_number' => 'required|string|max:15',
            'po_box' => 'required|string|max:15',
            'tin_number' => 'required|string|max:15',
            'abbreviation' => 'required|string|max:15',
        ]);

       


        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();

    // Handle file upload after validation
    if ($request->hasFile('logo')) {
        $path = $request->file('logo')->store('logos', 'public');
        $validated['logo'] = $path;
    }

        $organization = Organization::create($validated);

        return response()->json([
            'message' => 'Organization registered successfully.',
            'data' => new OrganizationResource($organization)
        ], 201);
    }


    public function show(Organization $organization) 
    {
        return new OrganizationResource($organization);

    }
    public function update(Request $request, Organization $organization) 
{
    // Validate first
    $validator = Validator::make($request->all(), [
        'en_name' => 'required|string|max:255',
        'motto' => 'required|string|max:255',
        'mission' => 'required|string|max:255',
        'vision' => 'required|string|max:255',
        'core_value' => 'required|string|max:255',
        'logo' => 'nullable|file|mimes:jpg,jpeg,png,ico,gif,svg,webp|max:2048',
        'address' => 'nullable|string|max:255',
        'website' => 'nullable|string',
        'email' => 'required|string|max:255',
        'phone_number' => 'required|string|max:15',
        'fax_number' => 'required|string|max:15',
        'po_box' => 'required|string|max:15',
        'tin_number' => 'required|string|max:15',
        'abbreviation' => 'required|string|max:15',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
        ], 422);
    }

    // Get validated data
    $validated = $validator->validated();

    // Handle file upload after validation
    if ($request->hasFile('logo')) {
        $path = $request->file('logo')->store('logos', 'public');
        $validated['logo'] = $path;
    }

    // Update organization with validated data + logo path if uploaded
    $organization->update($validated);

    return response()->json([
        'message' => 'Organization updated successfully.',
        'data' => new OrganizationResource($organization),
    ], 200);
}

    public function destroy(Organization $organization) 
    {
        $organization->delete();
        return response() ->json([
            'message' => 'Organization Deleted Successfully',
        ],200);


    }
}
