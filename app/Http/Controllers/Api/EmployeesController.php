<?php 

namespace App\Http\Controllers\Api;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeesController extends Controller
{
    public function index() 
    {
        $employees = Employee::get();
        if($employees->count() > 0)
        {
            return EmployeeResource::collection($employees);

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
            'title' => 'required|string|max:255',
            'sex' => 'required|string|in:male,female',
            'date_of_birth' => 'nullable|date',
            'joined_date' => 'nullable|date',
            'photo' => 'nullable|string',
            'phone_number' => 'required|string|max:15',
            'organization_unit_id' => 'required|integer',
            'job_position_id' => 'required|integer',
            'job_title_category_id' => 'required|integer',
            'salary_id' => 'required|integer',
            'martial_status_id' => 'required|integer',
            'nation' => 'required|string|max:255',
            'employment_id' => 'required|integer',
            'job_position_start_date' => 'nullable|date',
            'job_position_end_date' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'house_number' => 'nullable|string|max:50',
            'region_id' => 'required|integer',
            'zone_id' => 'required|integer',
            'woreda_id' => 'required|integer',
            'status' => 'required|string|max:50',
            'id_issue_date' => 'nullable|date',
            'id_expire_date' => 'nullable|date',
            'id_status' => 'required|string|max:50',
        ]);


        // 2. Create the employee record
        if($validator->fails()){
            return response()->json([
                'message' => 'All fields are required',
                'error' => $validator->messages(),
            ],422);
        }

        $employee = Employee::create([
            'en_name' => $request->en_name,
            'title' => $request->title,
            'sex' => $request->sex,
            'date_of_birth' => $request->date_of_birth ?: null,
            'joined_date' => $request->joined_date ?: null,
            'photo' => $request->photo,
            'phone_number' => $request->phone_number,
            'organization_unit_id' => $request->organization_unit_id,
            'job_position_id' => $request->job_position_id,
            'job_title_category_id' => $request->job_title_category_id,
            'salary_id' => $request->salary_id,
            'martial_status_id' => $request->martial_status_id,
            'nation' => $request->nation,
            'employment_id' => $request->employment_id,
            'job_position_start_date' => $request->job_position_start_date ?: null,
            'job_position_end_date' => $request->job_position_end_date ?: null,
            'address' => $request->address,
            'house_number' => $request->house_number,
            'region_id' => $request->region_id,
            'zone_id' => $request->zone_id,
            'woreda_id' => $request->woreda_id,
            'status' => $request->status,
            'id_issue_date' => $request->id_issue_date ?: null,
            'id_expire_date' => $request->id_expire_date ?: null,
            'id_status' => $request->id_status,
        ]);


        // 3. Return JSON response
        return response()->json([
            'message' => 'Employee registered successfully.',
            'data' => new EmployeeResource($employee)
        ], 200);
    }

    public function show(Employee $employee) 
    {
        return new EmployeeResource($employee);

    }
    public function update(Request $request,Employee $employee) 
    {
         $validator = Validator::make($request->all(), [
            'en_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'sex' => 'required|string|in:male,female',
            'date_of_birth' => 'nullable|date',
            'joined_date' => 'nullable|date',
            'photo' => 'nullable|string',
            'phone_number' => 'required|string|max:15',
            'organization_unit_id' => 'required|integer',
            'job_position_id' => 'required|integer',
            'job_title_category_id' => 'required|integer',
            'salary_id' => 'required|integer',
            'martial_status_id' => 'required|integer',
            'nation' => 'required|string|max:255',
            'employment_id' => 'required|integer',
            'job_position_start_date' => 'nullable|date',
            'job_position_end_date' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'house_number' => 'nullable|string|max:50',
            'region_id' => 'required|integer',
            'zone_id' => 'required|integer',
            'woreda_id' => 'required|integer',
            'status' => 'required|string|max:50',
            'id_issue_date' => 'nullable|date',
            'id_expire_date' => 'nullable|date',
            'id_status' => 'required|string|max:50',
        ]);


        // 2. Create the employee record
        if($validator->fails()){
            return response()->json([
                'message' => 'All fields are required',
                'error' => $validator->messages(),
            ],422);
        }

        $employee->update([
            'en_name' => $request->en_name,
            'title' => $request->title,
            'sex' => $request->sex,
            'date_of_birth' => $request->date_of_birth ?: null,
            'joined_date' => $request->joined_date ?: null,
            'photo' => $request->photo,
            'phone_number' => $request->phone_number,
            'organization_unit_id' => $request->organization_unit_id,
            'job_position_id' => $request->job_position_id,
            'job_title_category_id' => $request->job_title_category_id,
            'salary_id' => $request->salary_id,
            'martial_status_id' => $request->martial_status_id,
            'nation' => $request->nation,
            'employment_id' => $request->employment_id,
            'job_position_start_date' => $request->job_position_start_date ?: null,
            'job_position_end_date' => $request->job_position_end_date ?: null,
            'address' => $request->address,
            'house_number' => $request->house_number,
            'region_id' => $request->region_id,
            'zone_id' => $request->zone_id,
            'woreda_id' => $request->woreda_id,
            'status' => $request->status,
            'id_issue_date' => $request->id_issue_date ?: null,
            'id_expire_date' => $request->id_expire_date ?: null,
            'id_status' => $request->id_status,
        ]);

        return response() ->json([
            'message' => 'Employee updated Successfully',
            'date' => new EmployeeResource($employee)
        ],200);


    }
    public function destroy(Employee $employee) 
    {
        $employee->delete();
        return response() ->json([
            'message' => 'Employee Deleted Successfully',
        ],200);


    }
}