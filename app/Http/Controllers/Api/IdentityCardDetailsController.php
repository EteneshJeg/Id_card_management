<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\IdentityCardDetailsResource;
use App\Models\IdentityCardDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IdentityCardDetailsController extends Controller
{
    public function index() 
    {
        $identityCardDetails = IdentityCardDetail::get();
        if($identityCardDetails->count() > 0) 
        {
            return IdentityCardDetailsResource::collection($identityCardDetails);
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
            'field_label' => 'required|string|max:255',
            'label_length' => 'nullable|integer',
            'field_name' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'text_content' => 'nullable|string',
            'text_positionx' => 'nullable|numeric',
            'text_positiony' => 'nullable|numeric',
            'text_font_type' => 'nullable|string|max:100',
            'text_font_size' => 'nullable|integer',
            'text_font_color' => 'nullable|string|max:50',
            'image_file' => 'nullable|string|max:255',
            'image_width' => 'nullable|numeric',
            'image_height' => 'nullable|numeric',
            'has_mask' => 'nullable|boolean',
            'circle_diameter' => 'nullable|numeric',
            'circle_positionx' => 'nullable|numeric',
            'circle_positiony' => 'nullable|numeric',
            'circle_background' => 'nullable|string|max:50',
            'status' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'error' => $validator->messages(),
            ], 422);
        }

        $cardDetail = IdentityCardDetail::create($request->all());

        return response()->json([
            'message' => 'Identity Card Detail created successfully.',
            'data' => new IdentityCardDetailsResource($cardDetail)
        ], 200);
    }

    public function show(IdentityCardDetail $identityCardDetail) 
    {
        return new IdentityCardDetailsResource($identityCardDetail);
    }

    public function update(Request $request, IdentityCardDetail $identityCardDetail) 
    {
        $validator = Validator::make($request->all(), [
            'field_label' => 'required|string|max:255',
            'label_length' => 'nullable|integer',
            'field_name' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'text_content' => 'nullable|string',
            'text_positionx' => 'nullable|numeric',
            'text_positiony' => 'nullable|numeric',
            'text_font_type' => 'nullable|string|max:100',
            'text_font_size' => 'nullable|integer',
            'text_font_color' => 'nullable|string|max:50',
            'image_file' => 'nullable|string|max:255',
            'image_width' => 'nullable|numeric',
            'image_height' => 'nullable|numeric',
            'has_mask' => 'nullable|boolean',
            'circle_diameter' => 'nullable|numeric',
            'circle_positionx' => 'nullable|numeric',
            'circle_positiony' => 'nullable|numeric',
            'circle_background' => 'nullable|string|max:50',
            'status' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'error' => $validator->messages(),
            ], 422);
        }

        $identityCardDetail->update($request->all());

        return response()->json([
            'message' => 'Identity Card Detail updated successfully.',
            'data' => new IdentityCardDetailsResource($identityCardDetail)
        ], 200);
    }

    public function destroy(IdentityCardDetail $identityCardDetail) 
    {
        $identityCardDetail->delete();
        return response()->json([
            'message' => 'Identity Card Detail deleted successfully.'
        ], 200);
    }
}
