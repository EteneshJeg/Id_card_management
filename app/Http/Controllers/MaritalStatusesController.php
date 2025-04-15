<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MaritalStatus;
use Illuminate\Http\Request;
use Exception;

class MaritalStatusesController extends Controller
{

    /**
     * Display a listing of the marital statuses.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $maritalStatuses = MaritalStatus::paginate(25);

        return view('marital_statuses.index', compact('maritalStatuses'));
    }

    /**
     * Show the form for creating a new marital status.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('marital_statuses.create');
    }

    /**
     * Store a new marital status in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $data = $this->getData($request);
        
        MaritalStatus::create($data);

        return redirect()->route('marital_statuses.marital_status.index')
            ->with('success_message', 'Marital Status was successfully added.');
    }

    /**
     * Display the specified marital status.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $maritalStatus = MaritalStatus::findOrFail($id);

        return view('marital_statuses.show', compact('maritalStatus'));
    }

    /**
     * Show the form for editing the specified marital status.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $maritalStatus = MaritalStatus::findOrFail($id);
        

        return view('marital_statuses.edit', compact('maritalStatus'));
    }

    /**
     * Update the specified marital status in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $data = $this->getData($request);
        
        $maritalStatus = MaritalStatus::findOrFail($id);
        $maritalStatus->update($data);

        return redirect()->route('marital_statuses.marital_status.index')
            ->with('success_message', 'Marital Status was successfully updated.');  
    }

    /**
     * Remove the specified marital status from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $maritalStatus = MaritalStatus::findOrFail($id);
            $maritalStatus->delete();

            return redirect()->route('marital_statuses.marital_status.index')
                ->with('success_message', 'Marital Status was successfully deleted.');
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
        ];

        
        $data = $request->validate($rules);




        return $data;
    }

}
