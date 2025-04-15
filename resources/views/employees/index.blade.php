@extends('layouts.app')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {!! session('success_message') !!}

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card text-bg-theme">

        <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">Employees</h4>
            <div>
                <a href="{{ route('employees.employee.create') }}" class="btn btn-secondary" title="Create New Employee">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($employees) == 0)
            <div class="card-body text-center">
                <h4>No Employees Available.</h4>
            </div>
        @else
        <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>En Name</th>
                            <th>Title</th>
                            <th>Sex</th>
                            <th>Date Of Birth</th>
                            <th>Joined Date</th>
                            <th>Phone Number</th>
                            <th>Organization Unit</th>
                            <th>Job Position</th>
                            <th>Job Title Category</th>
                            <th>Salary</th>
                            <th>Martial Status</th>
                            <th>Nation</th>
                            <th>Employment</th>
                            <th>Job Position Start Date</th>
                            <th>Job Position End Date</th>
                            <th>Address</th>
                            <th>House Number</th>
                            <th>Region</th>
                            <th>Zone</th>
                            <th>Woreda</th>
                            <th>Status</th>
                            <th>Id Issue Date</th>
                            <th>Id Expire Date</th>
                            <th>Id Status</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($employees as $employee)
                        <tr>
                            <td class="align-middle">{{ $employee->en_name }}</td>
                            <td class="align-middle">{{ $employee->title }}</td>
                            <td class="align-middle">{{ $employee->sex }}</td>
                            <td class="align-middle">{{ $employee->date_of_birth }}</td>
                            <td class="align-middle">{{ $employee->joined_date }}</td>
                            <td class="align-middle">{{ $employee->phone_number }}</td>
                            <td class="align-middle">{{ optional($employee->organizationUnit)->id }}</td>
                            <td class="align-middle">{{ optional($employee->jobPosition)->id }}</td>
                            <td class="align-middle">{{ optional($employee->jobTitleCategory)->id }}</td>
                            <td class="align-middle">{{ optional($employee->salary)->id }}</td>
                            <td class="align-middle">{{ optional($employee->martialStatus)->id }}</td>
                            <td class="align-middle">{{ $employee->nation }}</td>
                            <td class="align-middle">{{ optional($employee->employment)->id }}</td>
                            <td class="align-middle">{{ $employee->job_position_start_date }}</td>
                            <td class="align-middle">{{ $employee->job_position_end_date }}</td>
                            <td class="align-middle">{{ $employee->address }}</td>
                            <td class="align-middle">{{ $employee->house_number }}</td>
                            <td class="align-middle">{{ optional($employee->region)->id }}</td>
                            <td class="align-middle">{{ optional($employee->zone)->id }}</td>
                            <td class="align-middle">{{ optional($employee->woreda)->id }}</td>
                            <td class="align-middle">{{ $employee->status }}</td>
                            <td class="align-middle">{{ $employee->id_issue_date }}</td>
                            <td class="align-middle">{{ $employee->id_expire_date }}</td>
                            <td class="align-middle">{{ $employee->id_status }}</td>

                            <td class="text-end">

                                <form method="POST" action="{!! route('employees.employee.destroy', $employee->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('employees.employee.show', $employee->id ) }}" class="btn btn-info" title="Show Employee">
                                            <span class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('employees.employee.edit', $employee->id ) }}" class="btn btn-primary" title="Edit Employee">
                                            <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Employee" onclick="return confirm(&quot;Click Ok to delete Employee.&quot;)">
                                            <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                                        </button>
                                    </div>

                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

            {!! $employees->links('pagination') !!}
        </div>
        
        @endif
    
    </div>
@endsection