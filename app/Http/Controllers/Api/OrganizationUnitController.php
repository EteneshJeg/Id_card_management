<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrganizationUnitResource;
use App\Models\OrganizationUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrganizationUnitController extends Controller
{
    public function index() 
    {
        $organizationUnits = OrganizationUnit::get();
        if ($organizationUnits->count() > 0) {
            return OrganizationUnitResource::collection($organizationUnits);
        } else {
            return response()->json(['message' => 'No record available'], 200);
        }
    }

    public function store(Request $request) 
    {
        // 1. Validate the request
        $validator = Validator::make($request->all(), [
            'en_name' => 'required|string|max:255',
            'en_acronym' => 'required|string|max:255',
            'parent' => 'required|string|max:255',
            'reports_to' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'is_root_unit' => 'required|string|max:255',
            'is_category' => 'required|string|max:255',
            'synchronize_status' => 'required|string|max:255',
            'chairman' => 'required|string|max:255',
        ]);

        // 2. Return validation errors if any
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'error' => $validator->messages(),
            ], 422);
        }

        // 3. Create the organization unit with validated data
        $organizationUnit = OrganizationUnit::create($request->all());

        // 4. Return JSON response with the created resource
        return response()->json([
            'message' => 'Organization unit registered successfully.',
            'data' => new OrganizationUnitResource($organizationUnit)
        ], 200);
    }

    public function show(OrganizationUnit $organizationUnit) 
    {
        return new OrganizationUnitResource($organizationUnit);
    }

    public function update(Request $request, OrganizationUnit $organizationUnit) 
    {
        // 1. Validate the request
        $validator = Validator::make($request->all(), [
            'en_name' => 'required|string|max:255',
            'en_acronym' => 'required|string|max:255',
            'parent' => 'required|string|max:255',
            'reports_to' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'is_root_unit' => 'required|string|max:255',
            'is_category' => 'required|string|max:255',
            'synchronize_status' => 'required|string|max:255',
            'chairman' => 'required|string|max:255',
        ]);

        // 2. Return validation errors if any
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'error' => $validator->messages(),
            ], 422);
        }

        // 3. Update the organization unit with validated data
        $organizationUnit->update($request->all());

        // 4. Return JSON response with the updated resource
        return response()->json([
            'message' => 'Organization unit updated successfully.',
            'data' => new OrganizationUnitResource($organizationUnit)
        ], 200);
    }

    public function destroy(OrganizationUnit $organizationUnit) 
    {
        // 1. Delete the organization unit
        $organizationUnit->delete();

        // 2. Return JSON response for successful deletion
        return response()->json([
            'message' => 'Organization unit deleted successfully.',
        ], 200);
    }
}
