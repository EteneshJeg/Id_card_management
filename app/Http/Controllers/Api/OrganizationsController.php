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
        // 1. Validate the request

        $validator = Validator::make($request->all(), [
            'en_name' => 'required|string|max:255',
            'motto' => 'required|string|max:255',
            'mission' => 'required|string|max:255',
            'vision' => 'required|string|max:255',
            'core_value' => 'required|string|max:255',
            'logo' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'website' => 'nullable|string',
            'email' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'fax_number' => 'required|string|max:15',
            'po_box' => 'required|string|max:15',
            'tin_number' => 'required|string|max:15',
            'abbreviation' => 'required|string|max:15',

        ]);


        // 2. Create the employee record
        if($validator->fails()){
            return response()->json([
                'message' => 'All fields are required',
                'error' => $validator->messages(),
            ],422);
        }

        $organizations = Organization::create([
            'en_name' => 'required|string|max:255',
            'motto' => 'required|string|max:255',
            'mission' => 'required|string|max:255',
            'vision' => 'required|string|max:255',
            'core_value' => 'required|string|max:255',
            'logo' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'website' => 'nullable|string',
            'email' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'fax_number' => 'required|string|max:15',
            'po_box' => 'required|string|max:15',
            'tin_number' => 'required|string|max:15',
            'abbreviation' => 'required|string|max:15',
        ]);


        // 3. Return JSON response
        return response()->json([
            'message' => 'Organization registered successfully.',
            'data' => new OrganizationResource($organizations)
        ], 200);
    }

    public function show(Organization $organizations) 
    {
        return new OrganizationResource($organizations);

    }
    public function update(Request $request,Organization $organizations) 
    {
        $validator = Validator::make($request->all(), [
            'en_name' => 'required|string|max:255',
            'motto' => 'required|string|max:255',
            'mission' => 'required|string|max:255',
            'vision' => 'required|string|max:255',
            'core_value' => 'required|string|max:255',
            'logo' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'website' => 'nullable|string',
            'email' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'fax_number' => 'required|string|max:15',
            'po_box' => 'required|string|max:15',
            'tin_number' => 'required|string|max:15',
            'abbreviation' => 'required|string|max:15',
        ]);


        // 2. Create the employee record
        if($validator->fails()){
            return response()->json([
                'message' => 'All fields are required',
                'error' => $validator->messages(),
            ],422);
        }

        $organizations->update([
            'en_name' => 'required|string|max:255',
            'motto' => 'required|string|max:255',
            'mission' => 'required|string|max:255',
            'vision' => 'required|string|max:255',
            'core_value' => 'required|string|max:255',
            'logo' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'website' => 'nullable|string',
            'email' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'fax_number' => 'required|string|max:15',
            'po_box' => 'required|string|max:15',
            'tin_number' => 'required|string|max:15',
            'abbreviation' => 'required|string|max:15',
        ]);

        return response() ->json([
            'message' => 'Organization updated Successfully',
            'date' => new OrganizationResource($organizations)
        ],200);


    }
    public function destroy(Organization $organizations) 
    {
        $organizations->delete();
        return response() ->json([
            'message' => 'Organization Deleted Successfully',
        ],200);


    }
}
