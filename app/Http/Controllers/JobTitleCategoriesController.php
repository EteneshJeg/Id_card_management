<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\JobTitleCategory;
use Illuminate\Http\Request;
use Exception;

class JobTitleCategoriesController extends Controller
{

    /**
     * Display a listing of the job title categories.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $jobTitleCategories = JobTitleCategory::paginate(25);

        return view('job_title_categories.index', compact('jobTitleCategories'));
    }

    /**
     * Show the form for creating a new job title category.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('job_title_categories.create');
    }

    /**
     * Store a new job title category in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $data = $this->getData($request);
        
        JobTitleCategory::create($data);

        return redirect()->route('job_title_categories.job_title_category.index')
            ->with('success_message', 'Job Title Category was successfully added.');
    }

    /**
     * Display the specified job title category.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $jobTitleCategory = JobTitleCategory::findOrFail($id);

        return view('job_title_categories.show', compact('jobTitleCategory'));
    }

    /**
     * Show the form for editing the specified job title category.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $jobTitleCategory = JobTitleCategory::findOrFail($id);
        

        return view('job_title_categories.edit', compact('jobTitleCategory'));
    }

    /**
     * Update the specified job title category in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $data = $this->getData($request);
        
        $jobTitleCategory = JobTitleCategory::findOrFail($id);
        $jobTitleCategory->update($data);

        return redirect()->route('job_title_categories.job_title_category.index')
            ->with('success_message', 'Job Title Category was successfully updated.');  
    }

    /**
     * Remove the specified job title category from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $jobTitleCategory = JobTitleCategory::findOrFail($id);
            $jobTitleCategory->delete();

            return redirect()->route('job_title_categories.job_title_category.index')
                ->with('success_message', 'Job Title Category was successfully deleted.');
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
                'name' => 'string|min:1|max:255|nullable',
            'description' => 'string|min:1|max:1000|nullable',
            'parent' => 'string|min:1|nullable', 
        ];

        
        $data = $request->validate($rules);




        return $data;
    }

}
