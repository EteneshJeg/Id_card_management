@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Identity Card Templates</h1>
        
        @if($identityCardTemplates->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($identityCardTemplates as $template)
                        <tr>
                            <td>{{ $template->type }}</td>
                            <td>{{ $template->status }}</td>
                            <td>
                                <a href="{{ route('identity_card_templates.show', $template->id) }}" class="btn btn-info">
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            {{ $identityCardTemplates->links() }}
        @else
            <div class="alert alert-warning">
                No templates found!
            </div>
        @endif
    </div>
@endsection