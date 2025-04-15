<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\IdentityCardTemplateDetailsResource;
use App\Http\Resources\IdentityCardTemplatesResource;
use App\Models\IdentityCardTemplate;
use App\Models\IdentityCardTemplateDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IdentityCardTemplateDetailsController extends Controller
{
    public function index() 
    {
        $identityCardTemplateDetail = IdentityCardTemplateDetail::get();
        if($identityCardTemplateDetail->count() > 0) 
        {
            return IdentityCardTemplateDetailsResource::collection($identityCardTemplateDetail);
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
            'identity_card_template_id' => 'required|string|max:50',
            'identity_card_detail_id' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'error' => $validator->messages(),
            ], 422);
        }

        $identityCardTemplateDetail = IdentityCardTemplateDetail::create($request->all());

        return response()->json([
            'message' => 'Identity Card Template Details created successfully.',
            'data' => new IdentityCardTemplateDetailsResource($identityCardTemplateDetail)
        ], 200);

    }

    public function show(IdentityCardTemplateDetail $identityCardTemplateDetail) 
    {
        return new IdentityCardTemplateDetailsResource($identityCardTemplateDetail);
    }

    public function update(Request $request, IdentityCardTemplateDetail $identityCardTemplateDetail) 
    {
            $validator = Validator::make($request->all(), [
            'identity_card_template_id' => 'required|string|max:50',
            'identity_card_detail_id' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'error' => $validator->messages(),
            ], 422);
        }

        $identityCardTemplateDetail->update($request->all());

        return response()->json([
            'message' => 'Identity Card Template Details updated successfully.',
            'data' => new IdentityCardTemplateDetailsResource($identityCardTemplateDetail)
        ], 200);
    }

    public function destroy(IdentityCardTemplateDetail $identityCardTemplateDetail) 
    {
        $identityCardTemplateDetail->delete();
        return response()->json([
            'message' => 'Identity Card Template Detail deleted successfully.'
        ], 200);
    }
}
