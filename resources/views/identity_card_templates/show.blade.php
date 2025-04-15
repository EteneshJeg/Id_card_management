@extends('layouts.app')

@section('content')

<div class="card text-bg-theme">

     <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($title) ? $title : 'Identity Card Template' }}</h4>
        <div>
            <form method="POST" action="{!! route('identity_card_templates.identity_card_template.destroy', $identityCardTemplate->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('identity_card_templates.identity_card_template.edit', $identityCardTemplate->id ) }}" class="btn btn-primary" title="Edit Identity Card Template">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Delete Identity Card Template" onclick="return confirm(&quot;Click Ok to delete Identity Card Template.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button>

                <a href="{{ route('identity_card_templates.identity_card_template.index') }}" class="btn btn-primary" title="Show All Identity Card Template">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('identity_card_templates.identity_card_template.create') }}" class="btn btn-secondary" title="Create New Identity Card Template">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Type</dt>
            <dd class="col-lg-10 col-xl-9">{{ $identityCardTemplate->type }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">File</dt>
            <dd class="col-lg-10 col-xl-9">{{ asset('storage/' . $identityCardTemplate->file) }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Sample File</dt>
            <dd class="col-lg-10 col-xl-9">{{ $identityCardTemplate->sample_file }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Status</dt>
            <dd class="col-lg-10 col-xl-9">{{ $identityCardTemplate->status }}</dd>

        </dl>

    </div>
</div>

@endsection