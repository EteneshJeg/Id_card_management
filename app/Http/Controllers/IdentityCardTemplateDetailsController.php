<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\IdentityCardDetail;
use App\Models\IdentityCardTemplate;
use App\Models\IdentityCardTemplateDetail;
use Illuminate\Http\Request;
use Exception;

class IdentityCardTemplateDetailsController extends Controller
{

    /**
     * Display a listing of the identity card template details.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $identityCardTemplateDetails = IdentityCardTemplateDetail::with('identitycardtemplate','identitycarddetail')->paginate(25);

        return view('identity_card_template_details.index', compact('identityCardTemplateDetails'));
    }

    /**
     * Show the form for creating a new identity card template detail.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $identityCardTemplates = IdentityCardTemplate::pluck('type','id')->all();
$identityCardDetails = IdentityCardDetail::pluck('created_at','id')->all();
        
        return view('identity_card_template_details.create', compact('identityCardTemplates','identityCardDetails'));
    }

    /**
     * Store a new identity card template detail in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $data = $this->getData($request);
        
        IdentityCardTemplateDetail::create($data);

        return redirect()->route('identity_card_template_details.identity_card_template_detail.index')
            ->with('success_message', 'Identity Card Template Detail was successfully added.');
    }

    /**
     * Display the specified identity card template detail.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $identityCardTemplateDetail = IdentityCardTemplateDetail::with('identitycardtemplate','identitycarddetail')->findOrFail($id);

        return view('identity_card_template_details.show', compact('identityCardTemplateDetail'));
    }

    /**
     * Show the form for editing the specified identity card template detail.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $identityCardTemplateDetail = IdentityCardTemplateDetail::findOrFail($id);
        $identityCardTemplates = IdentityCardTemplate::pluck('type','id')->all();
$identityCardDetails = IdentityCardDetail::pluck('created_at','id')->all();

        return view('identity_card_template_details.edit', compact('identityCardTemplateDetail','identityCardTemplates','identityCardDetails'));
    }

    /**
     * Update the specified identity card template detail in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $data = $this->getData($request);
        
        $identityCardTemplateDetail = IdentityCardTemplateDetail::findOrFail($id);
        $identityCardTemplateDetail->update($data);

        return redirect()->route('identity_card_template_details.identity_card_template_detail.index')
            ->with('success_message', 'Identity Card Template Detail was successfully updated.');  
    }

    /**
     * Remove the specified identity card template detail from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $identityCardTemplateDetail = IdentityCardTemplateDetail::findOrFail($id);
            $identityCardTemplateDetail->delete();

            return redirect()->route('identity_card_template_details.identity_card_template_detail.index')
                ->with('success_message', 'Identity Card Template Detail was successfully deleted.');
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
                'identity_card_template_id' => 'nullable',
            'identity_card_detail_id' => 'nullable', 
        ];

        
        $data = $request->validate($rules);




        return $data;
    }

}
