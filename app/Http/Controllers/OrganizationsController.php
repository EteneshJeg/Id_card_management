<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use Exception;

class OrganizationsController extends Controller
{

    /**
     * Display a listing of the organizations.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $organizations = Organization::paginate(25);

        return view('organizations.index', compact('organizations'));
    }

    /**
     * Show the form for creating a new organization.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('organizations.create');
    }

    /**
     * Store a new organization in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $data = $this->getData($request);
        
        Organization::create($data);

        return redirect()->route('organizations.organization.index')
            ->with('success_message', 'Organization was successfully added.');
    }

    /**
     * Display the specified organization.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $organization = Organization::findOrFail($id);

        return view('organizations.show', compact('organization'));
    }

    /**
     * Show the form for editing the specified organization.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $organization = Organization::findOrFail($id);
        

        return view('organizations.edit', compact('organization'));
    }

    /**
     * Update the specified organization in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $data = $this->getData($request);
        
        $organization = Organization::findOrFail($id);
        $organization->update($data);

        return redirect()->route('organizations.organization.index')
            ->with('success_message', 'Organization was successfully updated.');  
    }

    /**
     * Remove the specified organization from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $organization = Organization::findOrFail($id);
            $organization->delete();

            return redirect()->route('organizations.organization.index')
                ->with('success_message', 'Organization was successfully deleted.');
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
            'motto' => 'string|min:1|nullable',
            'mission' => 'string|min:1|nullable',
            'vision' => 'string|min:1|nullable',
            'core_value' => 'string|min:1|nullable',
            'logo' => 'string|min:1|nullable',
            'address' => 'string|min:1|nullable',
            'website' => 'string|min:1|nullable',
            'email' => 'nullable',
            'phone_number' => 'numeric|nullable',
            'fax_number' => 'numeric|nullable',
            'po_box' => 'string|min:1|nullable',
            'tin_number' => 'numeric|nullable',
            'abbreviation' => 'string|min:1|nullable', 
        ];

        
        $data = $request->validate($rules);




        return $data;
    }

}
