@extends('layouts.app')

@section('content')

<div class="card text-bg-theme">

     <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($employee->title) ? $employee->title : 'Employee' }}</h4>
        <div>
            <form method="POST" action="{!! route('employees.employee.destroy', $employee->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('employees.employee.edit', $employee->id ) }}" class="btn btn-primary" title="Edit Employee">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Delete Employee" onclick="return confirm(&quot;Click Ok to delete Employee.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button>

                <a href="{{ route('employees.employee.index') }}" class="btn btn-primary" title="Show All Employee">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('employees.employee.create') }}" class="btn btn-secondary" title="Create New Employee">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">En Name</dt>
            <dd class="col-lg-10 col-xl-9">{{ $employee->en_name }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Title</dt>
            <dd class="col-lg-10 col-xl-9">{{ $employee->title }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Sex</dt>
            <dd class="col-lg-10 col-xl-9">{{ $employee->sex }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Date Of Birth</dt>
            <dd class="col-lg-10 col-xl-9">{{ $employee->date_of_birth }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Joined Date</dt>
            <dd class="col-lg-10 col-xl-9">{{ $employee->joined_date }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Photo</dt>
            <dd class="col-lg-10 col-xl-9">{{ asset('storage/' . $employee->photo) }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Phone Number</dt>
            <dd class="col-lg-10 col-xl-9">{{ $employee->phone_number }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Organization Unit</dt>
            <dd class="col-lg-10 col-xl-9">{{ optional($employee->organizationUnit)->id }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Job Position</dt>
            <dd class="col-lg-10 col-xl-9">{{ optional($employee->jobPosition)->id }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Job Title Category</dt>
            <dd class="col-lg-10 col-xl-9">{{ optional($employee->jobTitleCategory)->id }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Salary</dt>
            <dd class="col-lg-10 col-xl-9">{{ optional($employee->salary)->id }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Martial Status</dt>
            <dd class="col-lg-10 col-xl-9">{{ optional($employee->martialStatus)->id }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Nation</dt>
            <dd class="col-lg-10 col-xl-9">{{ $employee->nation }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Employment</dt>
            <dd class="col-lg-10 col-xl-9">{{ optional($employee->employment)->id }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Job Position Start Date</dt>
            <dd class="col-lg-10 col-xl-9">{{ $employee->job_position_start_date }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Job Position End Date</dt>
            <dd class="col-lg-10 col-xl-9">{{ $employee->job_position_end_date }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Address</dt>
            <dd class="col-lg-10 col-xl-9">{{ $employee->address }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">House Number</dt>
            <dd class="col-lg-10 col-xl-9">{{ $employee->house_number }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Region</dt>
            <dd class="col-lg-10 col-xl-9">{{ optional($employee->region)->id }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Zone</dt>
            <dd class="col-lg-10 col-xl-9">{{ optional($employee->zone)->id }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Woreda</dt>
            <dd class="col-lg-10 col-xl-9">{{ optional($employee->woreda)->id }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Status</dt>
            <dd class="col-lg-10 col-xl-9">{{ $employee->status }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Id Issue Date</dt>
            <dd class="col-lg-10 col-xl-9">{{ $employee->id_issue_date }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Id Expire Date</dt>
            <dd class="col-lg-10 col-xl-9">{{ $employee->id_expire_date }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Id Status</dt>
            <dd class="col-lg-10 col-xl-9">{{ $employee->id_status }}</dd>

        </dl>

    </div>
</div>

@endsection