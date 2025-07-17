<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployeeIdentityCards;
use App\Http\Resources\EmployeeIdentityCardResource;
use Illuminate\Support\Facades\Validator;

class EmployeeIdentityCardsController extends Controller
{
    //
    public function index(){
        $employeeIdenityCards=EmployeeIdentityCards::get();
        if($employeeIdenityCards->count()>0){
            return EmployeeIdentityCardResource::collection($employeeIdenityCards);
        }
        else{
            return response()->json([
                "message"=>"No record available"
            ],status:200);
        }
    }

    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        '*.employee_id' => 'required|integer|exists:employees,id',
        '*.identity_card_template_id' => 'required|integer|exists:identity_card_templates,id',
        '*.image_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($validator->fails()) {
        return response()->json([
            "message" => "Validation failed",
            "error" => $validator->messages(),
        ], 422);
    }

    $validated = $validator->validated();
    $created = [];

    foreach ($validated as $cardData) {
        // Handle the image file upload for each cardData
        $imageFile = $cardData['image_file'];

        // Store the file in 'public/employee_id_cards'
        $fileName = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
        $path = $imageFile->storeAs('public/employee_id_cards', $fileName);

        // Replace the 'image_file' value with the accessible path (without 'public/')
        $cardData['image_file'] = 'storage/employee_id_cards/' . $fileName;

        // Create the record with updated $cardData
        $created[] = EmployeeIdentityCards::create($cardData);
    }

    return response()->json([
        'message' => 'Id card registered successfully.',
        'data' => EmployeeIdentityCardResource::collection($created), // use collection here for array
    ], 201);
}


    public function show(EmployeeIdentityCards $employee_identity_card)
{
    return response()->json([
        'message' => 'OK',
        'data' => new EmployeeIdentityCardResource($employee_identity_card)
    ], 200);
}




  public function update(Request $request, EmployeeIdentityCards $employee_identity_card)
{
    $validator = Validator::make($request->all(), [
        '*.employee_id' => 'required|integer|exists:employees,id',
        '*.identity_card_template_id' => 'required|integer|exists:identity_card_templates,id',
        '*.image_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    if ($validator->fails()) {
        return response()->json([
            "message" => "Validation failed",
            "error" => $validator->messages(),
        ], 422);
    }

    $validated = $validator->validated();
    $employee_identity_card->update($validated);

    $employee_identity_card->refresh();

    return response()->json([
        'message' => 'Id card updated successfully.',
        'data' => new EmployeeIdentityCardResource($employee_identity_card),
    ], 200);
}


    public function destroy(EmployeeIdentityCards $employee_identity_card){
        $employee_identity_card->delete();
        return response()->json([
            'message' => 'Identity Card  deleted successfully.'
        ], 200);
    }
}
