@extends('layouts.app')

@section('content')

    <div class="card text-bg-theme">

         <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">Create New Identity Card Template</h4>
            <div>
                <a href="{{ route('identity_card_templates.identity_card_template.index') }}" class="btn btn-primary" title="Show All Identity Card Template">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        

        <div class="card-body">
        
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul class="list-unstyled mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" class="needs-validation" novalidate action="{{ route('identity_card_templates.identity_card_template.store') }}" accept-charset="UTF-8" id="create_identity_card_template_form" name="create_identity_card_template_form"  enctype="multipart/form-data">
            {{ csrf_field() }}
            @include ('identity_card_templates.form', [
                                        'identityCardTemplate' => null,
                                      ])

                <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                    <input class="btn btn-primary" type="submit" value="Add">
                </div>

            </form>

        </div>
    </div>

@endsection


