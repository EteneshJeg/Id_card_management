<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Zone;
use Illuminate\Http\Request;
use Exception;

class ZonesController extends Controller
{

    /**
     * Display a listing of the zones.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $zones = Zone::paginate(25);

        return view('zones.index', compact('zones'));
    }

    /**
     * Show the form for creating a new zone.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('zones.create');
    }

    /**
     * Store a new zone in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $data = $this->getData($request);
        
        Zone::create($data);

        return redirect()->route('zones.zone.index')
            ->with('success_message', 'Zone was successfully added.');
    }

    /**
     * Display the specified zone.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $zone = Zone::findOrFail($id);

        return view('zones.show', compact('zone'));
    }

    /**
     * Show the form for editing the specified zone.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $zone = Zone::findOrFail($id);
        

        return view('zones.edit', compact('zone'));
    }

    /**
     * Update the specified zone in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $data = $this->getData($request);
        
        $zone = Zone::findOrFail($id);
        $zone->update($data);

        return redirect()->route('zones.zone.index')
            ->with('success_message', 'Zone was successfully updated.');  
    }

    /**
     * Remove the specified zone from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $zone = Zone::findOrFail($id);
            $zone->delete();

            return redirect()->route('zones.zone.index')
                ->with('success_message', 'Zone was successfully deleted.');
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
            'region' => 'string|min:1|nullable', 
        ];

        
        $data = $request->validate($rules);




        return $data;
    }

}
