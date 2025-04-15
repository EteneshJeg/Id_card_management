<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use Illuminate\Http\Request;
use Exception;

class SalariesController extends Controller
{

    /**
     * Display a listing of the salaries.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $salaries = Salary::paginate(25);

        return view('salaries.index', compact('salaries'));
    }

    /**
     * Show the form for creating a new salary.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('salaries.create');
    }

    /**
     * Store a new salary in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $data = $this->getData($request);
        
        Salary::create($data);

        return redirect()->route('salaries.salary.index')
            ->with('success_message', 'Salary was successfully added.');
    }

    /**
     * Display the specified salary.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $salary = Salary::findOrFail($id);

        return view('salaries.show', compact('salary'));
    }

    /**
     * Show the form for editing the specified salary.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $salary = Salary::findOrFail($id);
        

        return view('salaries.edit', compact('salary'));
    }

    /**
     * Update the specified salary in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $data = $this->getData($request);
        
        $salary = Salary::findOrFail($id);
        $salary->update($data);

        return redirect()->route('salaries.salary.index')
            ->with('success_message', 'Salary was successfully updated.');  
    }

    /**
     * Remove the specified salary from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $salary = Salary::findOrFail($id);
            $salary->delete();

            return redirect()->route('salaries.salary.index')
                ->with('success_message', 'Salary was successfully deleted.');
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
                'amount' => 'string|min:1|nullable',
            'status' => 'string|min:1|nullable', 
        ];

        
        $data = $request->validate($rules);




        return $data;
    }

}
