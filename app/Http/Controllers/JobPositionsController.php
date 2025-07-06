<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\JobPosition;
use App\Models\JobTitleCategory;
use App\Models\OrganizationUnit;
use App\Models\Position;
use App\Models\Salary;
use Illuminate\Http\Request;
use Exception;

class JobPositionsController extends Controller
{

    /**
     * Display a listing of the job positions.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $jobPositions = JobPosition::with('organizationunit','jobtitlecategory','position','salary')->paginate(25);

        return view('job_positions.index', compact('jobPositions'));
    }

    /**
     * Show the form for creating a new job position.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $organizationUnits = OrganizationUnit::pluck('id','id')->all();
$jobTitleCategories = JobTitleCategory::pluck('name','id')->all();
$positions = Position::pluck('id','id')->all();
        
        return view('job_positions.create', compact('organizationUnits','jobTitleCategories','positions'));
    }

    /**
     * Store a new job position in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $data = $this->getData($request);
        
        JobPosition::create($data);

        return redirect()->route('job_positions.job_position.index')
            ->with('success_message', 'Job Position was successfully added.');
    }

    /**
     * Display the specified job position.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $jobPosition = JobPosition::with('organizationunit','jobtitlecategory','position','salary')->findOrFail($id);

        return view('job_positions.show', compact('jobPosition'));
    }

    /**
     * Show the form for editing the specified job position.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $jobPosition = JobPosition::findOrFail($id);
        $organizationUnits = OrganizationUnit::pluck('id','id')->all();
$jobTitleCategories = JobTitleCategory::pluck('name','id')->all();
$positions = Position::pluck('id','id')->all();

        return view('job_positions.edit', compact('jobPosition','organizationUnits','jobTitleCategories','positions'));
    }

    /**
     * Update the specified job position in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $data = $this->getData($request);
        
        $jobPosition = JobPosition::findOrFail($id);
        $jobPosition->update($data);

        return redirect()->route('job_positions.job_position.index')
            ->with('success_message', 'Job Position was successfully updated.');  
    }

    /**
     * Remove the specified job position from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $jobPosition = JobPosition::findOrFail($id);
            $jobPosition->delete();

            return redirect()->route('job_positions.job_position.index')
                ->with('success_message', 'Job Position was successfully deleted.');
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
                'organization_unit_id' => 'nullable',
            'job_title_category_id' => 'nullable',
            'job_description' => 'string|min:1|nullable',
            'position_code' => 'string|min:1|nullable',
            'position_id' => 'nullable',
            'status' => 'string|min:1|nullable', 
        ];

        
        $data = $request->validate($rules);




        return $data;
    }

}
