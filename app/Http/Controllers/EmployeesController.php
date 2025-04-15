<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Employment;
use App\Models\JobPosition;
use App\Models\JobTitleCategory;
use App\Models\MartialStatus;
use App\Models\OrganizationUnit;
use App\Models\Region;
use App\Models\Salary;
use App\Models\Woreda;
use App\Models\Zone;
use Illuminate\Http\Request;
use Exception;

class EmployeesController extends Controller
{

    /**
     * Display a listing of the employees.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $employees = Employee::with('organizationunit','jobposition','jobtitlecategory','salary','martialstatus','employment','region','zone','woreda')->paginate(25);

        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new employee.
     *
     * @return \Illuminate\View\View
     */
    public function create()
        {
            try {
                $organizationUnits = OrganizationUnit::pluck('id', 'id')->all();
                $jobPositions = JobPosition::pluck('id', 'id')->all();
                $jobTitleCategories = JobTitleCategory::pluck('id', 'id')->all();
                $salaries = Salary::pluck('id', 'id')->all();
                $martialStatuses = MartialStatus::pluck('id', 'id')->all();
                $employments = Employment::pluck('id', 'id')->all();
                $regions = Region::pluck('id', 'id')->all();
                $zones = Zone::pluck('id', 'id')->all();
                $woredas = Woreda::pluck('id', 'id')->all();

                return response()->json([
                    'organizationUnits' => $organizationUnits,
                    'jobPositions' => $jobPositions,
                    'jobTitleCategories' => $jobTitleCategories,
                    'salaries' => $salaries,
                    'martialStatuses' => $martialStatuses,
                    'employments' => $employments,
                    'regions' => $regions,
                    'zones' => $zones,
                    'woredas' => $woredas,
                ], 200);

            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Something went wrong while fetching data.',
                    'error' => $e->getMessage(),
                ], 500);
            }
        }

    /**
     * Store a new employee in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $data = $this->getData($request);
        
        Employee::create($data);

        return redirect()->route('employees.employee.index')
            ->with('success_message', 'Employee was successfully added.');
    }

    /**
     * Display the specified employee.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $employee = Employee::with('organizationunit','jobposition','jobtitlecategory','salary','martialstatus','employment','region','zone','woreda')->findOrFail($id);

        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified employee.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $organizationUnits = OrganizationUnit::pluck('id','id')->all();
$jobPositions = JobPosition::pluck('id','id')->all();
$jobTitleCategories = JobTitleCategory::pluck('id','id')->all();
$salaries = Salary::pluck('id','id')->all();
$martialStatuses = MartialStatus::pluck('id','id')->all();
$employments = Employment::pluck('id','id')->all();
$regions = Region::pluck('id','id')->all();
$zones = Zone::pluck('id','id')->all();
$woredas = Woreda::pluck('id','id')->all();

        return view('employees.edit', compact('employee','organizationUnits','jobPositions','jobTitleCategories','salaries','martialStatuses','employments','regions','zones','woredas'));
    }

    /**
     * Update the specified employee in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $data = $this->getData($request);
        
        $employee = Employee::findOrFail($id);
        $employee->update($data);

        return redirect()->route('employees.employee.index')
            ->with('success_message', 'Employee was successfully updated.');  
    }

    /**
     * Remove the specified employee from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $employee->delete();

            return redirect()->route('employees.employee.index')
                ->with('success_message', 'Employee was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    
    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request 
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
                'en_name' => 'string|min:1|nullable',
            'title' => 'string|min:1|max:255|nullable',
            'sex' => 'string|min:1|nullable',
            'date_of_birth' => 'date_format:j/n/Y|nullable',
            'joined_date' => 'date_format:j/n/Y|nullable',
            'photo' => ['image','file','nullable'],
            'phone_number' => 'numeric|nullable',
            'organization_unit_id' => 'nullable',
            'job_position_id' => 'nullable',
            'job_title_category_id' => 'nullable',
            'salary_id' => 'nullable',
            'martial_status_id' => 'nullable',
            'nation' => 'string|min:1|nullable',
            'employment_id' => 'nullable',
            'job_position_start_date' => 'date_format:j/n/Y|nullable',
            'job_position_end_date' => 'date_format:j/n/Y|nullable',
            'address' => 'string|min:1|nullable',
            'house_number' => 'numeric|nullable',
            'region_id' => 'nullable',
            'zone_id' => 'nullable',
            'woreda_id' => 'nullable',
            'status' => 'string|min:1|nullable',
            'id_issue_date' => 'date_format:j/n/Y|nullable',
            'id_expire_date' => 'date_format:j/n/Y|nullable',
            'id_status' => 'string|min:1|nullable', 
        ];

        
        $data = $request->validate($rules);

        if ($request->has('custom_delete_photo')) {
            $data['photo'] = null;
        }
        if ($request->hasFile('photo')) {
            $data['photo'] = $this->moveFile($request->file('photo'));
        }



        return $data;
    }
  
    /**
     * Moves the attached file to the server.
     *
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return string
     */
    protected function moveFile($file)
    {
        if (!$file->isValid()) {
            return '';
        }
        
        $path = config('laravel-code-generator.files_upload_path', 'uploads');
        $saved = $file->store('public/' . $path, config('filesystems.default'));

        return substr($saved, 7);
    }

}
