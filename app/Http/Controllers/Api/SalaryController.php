<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SalaryResource;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SalaryController extends Controller
{
    public function index()
    {
        $salaries = Salary::all();

        if ($salaries->isNotEmpty()) {
            return SalaryResource::collection($salaries);
        }

        return response()->json(['message' => 'No record available'], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'All fields are required',
                'errors' => $validator->messages(),
            ], 422);
        }

        $salary = Salary::create([
            'amount' => $request->input('amount'),
            'status' => $request->input('status'),
        ]);

        return response()->json([
            'message' => 'Salary registered successfully.',
            'data' => new SalaryResource($salary),
        ], 200);
    }

    public function show(Salary $salary)
    {
        return new SalaryResource($salary);
    }

    public function update(Request $request, Salary $salary)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'All fields are required',
                'errors' => $validator->messages(),
            ], 422);
        }

        $salary->update([
            'amount' => $request->input('amount'),
            'status' => $request->input('status'),
        ]);

        return response()->json([
            'message' => 'Salary updated successfully',
            'data' => new SalaryResource($salary),
        ], 200);
    }

    public function destroy(Salary $salary)
    {
        $salary->delete();

        return response()->json([
            'message' => 'Salary deleted successfully',
        ], 200);
    }
}
