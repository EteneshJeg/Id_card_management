<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Woreda;
use Illuminate\Http\Request;
use Exception;

class WoredasController extends Controller
{

    /**
     * Display a listing of the woredas.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $woredas = Woreda::paginate(25);

        return view('woredas.index', compact('woredas'));
    }

    /**
     * Show the form for creating a new woreda.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('woredas.create');
    }

    /**
     * Store a new woreda in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $data = $this->getData($request);
        
        Woreda::create($data);

        return redirect()->route('woredas.woreda.index')
            ->with('success_message', 'Woreda was successfully added.');
    }

    /**
     * Display the specified woreda.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $woreda = Woreda::findOrFail($id);

        return view('woredas.show', compact('woreda'));
    }

    /**
     * Show the form for editing the specified woreda.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $woreda = Woreda::findOrFail($id);
        

        return view('woredas.edit', compact('woreda'));
    }

    /**
     * Update the specified woreda in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $data = $this->getData($request);
        
        $woreda = Woreda::findOrFail($id);
        $woreda->update($data);

        return redirect()->route('woredas.woreda.index')
            ->with('success_message', 'Woreda was successfully updated.');  
    }

    /**
     * Remove the specified woreda from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $woreda = Woreda::findOrFail($id);
            $woreda->delete();

            return redirect()->route('woredas.woreda.index')
                ->with('success_message', 'Woreda was successfully deleted.');
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
            'zone' => 'string|min:1|nullable', 
        ];

        
        $data = $request->validate($rules);




        return $data;
    }

}
