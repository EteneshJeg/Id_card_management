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
            'parent' => 'nullable|exists:organization_units,id',
            'reports_to' => 'nullable|string|max:255',
            'location' => 'required|string|max:255',
            'is_root_unit' => 'required|boolean',
            'is_category' => 'required|boolean',
            'synchronize_status' => 'required|string|max:255',
            'organization_id' => 'nullable|numeric',
            'chairman' => 'nullable|numeric',
        ]);

        // 2. Return validation errors if any
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'error' => $validator->messages(),
            ], 422);
        }

        // 3. Create the organization unit with validated data
        $validatedData = $validator->validated();
        $organizationUnit = OrganizationUnit::create($validatedData);

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
            'parent' => 'nullable|exists:organization_units,id',
            'reports_to' => 'nullable|string|max:255',
            'location' => 'required|string|max:255',
            'is_root_unit' => 'required|boolean',
            'is_category' => 'required|boolean',
            'synchronize_status' => 'required|string|max:255',
            'organization_id' => 'nullable|numeric',
            'chairman' => 'nullable|numeric',
        ]);

        // 2. Return validation errors if any
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'error' => $validator->messages(),
            ], 422);
        }

        // 3. Update the organization unit with validated data
        $validatedData = $validator->validated();
        $organizationUnit->update($validatedData);

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

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids');

        if (!is_array($ids) || empty($ids)) {
            return response()->json(['message' => 'No IDs provided'], 400);
        }

        $existingIds = OrganizationUnit::whereIn('id', $ids)->pluck('id')->toArray();

        if (empty($existingIds)) {
        return response()->json(['message' => 'Record not found.'], 404);
    }

        OrganizationUnit::whereIn('id', $existingIds)->delete();

        return response()->json(['message' => 'Selected units deleted successfully'], 200);
    }
}
