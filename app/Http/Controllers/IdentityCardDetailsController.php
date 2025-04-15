<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\IdentityCardDetail;
use Illuminate\Http\Request;
use Exception;

class IdentityCardDetailsController extends Controller
{

    /**
     * Display a listing of the identity card details.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $identityCardDetails = IdentityCardDetail::paginate(25);

        return view('identity_card_details.index', compact('identityCardDetails'));
    }

    /**
     * Show the form for creating a new identity card detail.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('identity_card_details.create');
    }

    /**
     * Store a new identity card detail in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $data = $this->getData($request);
        
        IdentityCardDetail::create($data);

        return redirect()->route('identity_card_details.identity_card_detail.index')
            ->with('success_message', 'Identity Card Detail was successfully added.');
    }

    /**
     * Display the specified identity card detail.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $identityCardDetail = IdentityCardDetail::findOrFail($id);

        return view('identity_card_details.show', compact('identityCardDetail'));
    }

    /**
     * Show the form for editing the specified identity card detail.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $identityCardDetail = IdentityCardDetail::findOrFail($id);
        

        return view('identity_card_details.edit', compact('identityCardDetail'));
    }

    /**
     * Update the specified identity card detail in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $data = $this->getData($request);
        
        $identityCardDetail = IdentityCardDetail::findOrFail($id);
        $identityCardDetail->update($data);

        return redirect()->route('identity_card_details.identity_card_detail.index')
            ->with('success_message', 'Identity Card Detail was successfully updated.');  
    }

    /**
     * Remove the specified identity card detail from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $identityCardDetail = IdentityCardDetail::findOrFail($id);
            $identityCardDetail->delete();

            return redirect()->route('identity_card_details.identity_card_detail.index')
                ->with('success_message', 'Identity Card Detail was successfully deleted.');
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
                'field_label' => 'string|min:1|nullable',
            'label_length' => 'string|min:1|nullable',
            'field_name' => 'string|min:1|nullable',
            'type' => 'string|min:1|nullable',
            'text_content' => 'string|min:1|nullable',
            'text_positionx' => 'string|min:1|nullable',
            'text_positiony' => 'string|min:1|nullable',
            'text_font_type' => 'string|min:1|nullable',
            'text_font_size' => 'string|min:1|nullable',
            'text_font_color' => 'string|min:1|nullable',
            'image_file' => 'numeric|nullable',
            'image_width' => 'numeric|nullable',
            'image_height' => 'numeric|nullable',
            'has_mask' => 'boolean|nullable',
            'circle_diameter' => 'string|min:1|nullable',
            'circle_positionx' => 'string|min:1|nullable',
            'circle_positiony' => 'string|min:1|nullable',
            'circle_background' => 'string|min:1|nullable',
            'status' => 'string|min:1|nullable', 
        ];

        
        $data = $request->validate($rules);


        $data['has_mask'] = $request->has('has_mask');


        return $data;
    }

}
