<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OrganizationUnit;
use Illuminate\Http\Request;
use Exception;

class OrganizationUnitsController extends Controller
{

    /**
     * Display a listing of the organization units.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $organizationUnits = OrganizationUnit::paginate(25);

        return view('organization_units.index', compact('organizationUnits'));
    }

    /**
     * Show the form for creating a new organization unit.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('organization_units.create');
    }

    /**
     * Store a new organization unit in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $data = $this->getData($request);
        
        OrganizationUnit::create($data);

        return redirect()->route('organization_units.organization_unit.index')
            ->with('success_message', 'Organization Unit was successfully added.');
    }

    /**
     * Display the specified organization unit.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $organizationUnit = OrganizationUnit::findOrFail($id);

        return view('organization_units.show', compact('organizationUnit'));
    }

    /**
     * Show the form for editing the specified organization unit.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $organizationUnit = OrganizationUnit::findOrFail($id);
        

        return view('organization_units.edit', compact('organizationUnit'));
    }

    /**
     * Update the specified organization unit in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $data = $this->getData($request);
        
        $organizationUnit = OrganizationUnit::findOrFail($id);
        $organizationUnit->update($data);

        return redirect()->route('organization_units.organization_unit.index')
            ->with('success_message', 'Organization Unit was successfully updated.');  
    }

    /**
     * Remove the specified organization unit from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $organizationUnit = OrganizationUnit::findOrFail($id);
            $organizationUnit->delete();

            return redirect()->route('organization_units.organization_unit.index')
                ->with('success_message', 'Organization Unit was successfully deleted.');
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
            'en_acronym' => 'string|min:1|nullable',
            'parent' => 'string|min:1|nullable',
            'reports_to' => 'string|min:1|nullable',
            'location' => 'string|min:1|nullable',
            'is_root_unit' => 'boolean|nullable',
            'is_category' => 'boolean|nullable',
            'synchronize_status' => 'string|min:1|nullable',
            'chairman' => 'string|min:1|nullable', 
        ];

        
        $data = $request->validate($rules);


        $data['is_root_unit'] = $request->has('is_root_unit');
        $data['is_category'] = $request->has('is_category');


        return $data;
    }

}
