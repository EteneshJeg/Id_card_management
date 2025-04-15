
<div class="mb-3 row">
    <label for="en_name" class="col-form-label text-lg-end col-lg-2 col-xl-3">En Name</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('en_name') ? ' is-invalid' : '' }}" name="en_name" type="text" id="en_name" value="{{ old('en_name', optional($employee)->en_name) }}" minlength="1" placeholder="Enter en name here...">
        {!! $errors->first('en_name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="title" class="col-form-label text-lg-end col-lg-2 col-xl-3">Title</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" type="text" id="title" value="{{ old('title', optional($employee)->title) }}" minlength="1" maxlength="255" placeholder="Enter title here...">
        {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="sex" class="col-form-label text-lg-end col-lg-2 col-xl-3">Sex</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('sex') ? ' is-invalid' : '' }}" name="sex" type="text" id="sex" value="{{ old('sex', optional($employee)->sex) }}" minlength="1" placeholder="Enter sex here...">
        {!! $errors->first('sex', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="date_of_birth" class="col-form-label text-lg-end col-lg-2 col-xl-3">Date Of Birth</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" name="date_of_birth" type="text" id="date_of_birth" value="{{ old('date_of_birth', optional($employee)->date_of_birth) }}" placeholder="Enter date of birth here...">
        {!! $errors->first('date_of_birth', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="joined_date" class="col-form-label text-lg-end col-lg-2 col-xl-3">Joined Date</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('joined_date') ? ' is-invalid' : '' }}" name="joined_date" type="text" id="joined_date" value="{{ old('joined_date', optional($employee)->joined_date) }}" placeholder="Enter joined date here...">
        {!! $errors->first('joined_date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="photo" class="col-form-label text-lg-end col-lg-2 col-xl-3">Photo</label>
    <div class="col-lg-10 col-xl-9">
        <div class="mb-3">
            <input class="form-control{{ $errors->has('photo') ? ' is-invalid' : '' }}" type="file" name="photo" id="photo" class="">
        </div>

        @if (isset($employee->photo) && !empty($employee->photo))

        <div class="input-group mb-3">
          <div class="form-check">
            <input type="checkbox" name="custom_delete_photo" id="custom_delete_photo" class="form-check-input custom-delete-file" value="1" {{ old('custom_delete_photo', '0') == '1' ? 'checked' : '' }}> 
          </div>
          <label class="form-check-label" for="custom_delete_photo"> Delete {{ $employee->photo }}</label>
        </div>

        @endif

        {!! $errors->first('photo', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="phone_number" class="col-form-label text-lg-end col-lg-2 col-xl-3">Phone Number</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" type="number" id="phone_number" value="{{ old('phone_number', optional($employee)->phone_number) }}" placeholder="Enter phone number here...">
        {!! $errors->first('phone_number', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="organization_unit_id" class="col-form-label text-lg-end col-lg-2 col-xl-3">Organization Unit</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-select{{ $errors->has('organization_unit_id') ? ' is-invalid' : '' }}" id="organization_unit_id" name="organization_unit_id">
        	    <option value="" style="display: none;" {{ old('organization_unit_id', optional($employee)->organization_unit_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select organization unit</option>
        	@foreach ($organizationUnits as $key => $organizationUnit)
			    <option value="{{ $key }}" {{ old('organization_unit_id', optional($employee)->organization_unit_id) == $key ? 'selected' : '' }}>
			    	{{ $organizationUnit }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('organization_unit_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="job_position_id" class="col-form-label text-lg-end col-lg-2 col-xl-3">Job Position</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-select{{ $errors->has('job_position_id') ? ' is-invalid' : '' }}" id="job_position_id" name="job_position_id">
        	    <option value="" style="display: none;" {{ old('job_position_id', optional($employee)->job_position_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select job position</option>
        	@foreach ($jobPositions as $key => $jobPosition)
			    <option value="{{ $key }}" {{ old('job_position_id', optional($employee)->job_position_id) == $key ? 'selected' : '' }}>
			    	{{ $jobPosition }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('job_position_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="job_title_category_id" class="col-form-label text-lg-end col-lg-2 col-xl-3">Job Title Category</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-select{{ $errors->has('job_title_category_id') ? ' is-invalid' : '' }}" id="job_title_category_id" name="job_title_category_id">
        	    <option value="" style="display: none;" {{ old('job_title_category_id', optional($employee)->job_title_category_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select job title category</option>
        	@foreach ($jobTitleCategories as $key => $jobTitleCategory)
			    <option value="{{ $key }}" {{ old('job_title_category_id', optional($employee)->job_title_category_id) == $key ? 'selected' : '' }}>
			    	{{ $jobTitleCategory }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('job_title_category_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="salary_id" class="col-form-label text-lg-end col-lg-2 col-xl-3">Salary</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-select{{ $errors->has('salary_id') ? ' is-invalid' : '' }}" id="salary_id" name="salary_id">
        	    <option value="" style="display: none;" {{ old('salary_id', optional($employee)->salary_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select salary</option>
        	@foreach ($salaries as $key => $salary)
			    <option value="{{ $key }}" {{ old('salary_id', optional($employee)->salary_id) == $key ? 'selected' : '' }}>
			    	{{ $salary }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('salary_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="martial_status_id" class="col-form-label text-lg-end col-lg-2 col-xl-3">Martial Status</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-select{{ $errors->has('martial_status_id') ? ' is-invalid' : '' }}" id="martial_status_id" name="martial_status_id">
        	    <option value="" style="display: none;" {{ old('martial_status_id', optional($employee)->martial_status_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select martial status</option>
        	@foreach ($martialStatuses as $key => $martialStatus)
			    <option value="{{ $key }}" {{ old('martial_status_id', optional($employee)->martial_status_id) == $key ? 'selected' : '' }}>
			    	{{ $martialStatus }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('martial_status_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="nation" class="col-form-label text-lg-end col-lg-2 col-xl-3">Nation</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('nation') ? ' is-invalid' : '' }}" name="nation" type="text" id="nation" value="{{ old('nation', optional($employee)->nation) }}" minlength="1" placeholder="Enter nation here...">
        {!! $errors->first('nation', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="employment_id" class="col-form-label text-lg-end col-lg-2 col-xl-3">Employment</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-select{{ $errors->has('employment_id') ? ' is-invalid' : '' }}" id="employment_id" name="employment_id">
        	    <option value="" style="display: none;" {{ old('employment_id', optional($employee)->employment_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select employment</option>
        	@foreach ($employments as $key => $employment)
			    <option value="{{ $key }}" {{ old('employment_id', optional($employee)->employment_id) == $key ? 'selected' : '' }}>
			    	{{ $employment }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('employment_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="job_position_start_date" class="col-form-label text-lg-end col-lg-2 col-xl-3">Job Position Start Date</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('job_position_start_date') ? ' is-invalid' : '' }}" name="job_position_start_date" type="text" id="job_position_start_date" value="{{ old('job_position_start_date', optional($employee)->job_position_start_date) }}" placeholder="Enter job position start date here...">
        {!! $errors->first('job_position_start_date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="job_position_end_date" class="col-form-label text-lg-end col-lg-2 col-xl-3">Job Position End Date</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('job_position_end_date') ? ' is-invalid' : '' }}" name="job_position_end_date" type="text" id="job_position_end_date" value="{{ old('job_position_end_date', optional($employee)->job_position_end_date) }}" placeholder="Enter job position end date here...">
        {!! $errors->first('job_position_end_date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="address" class="col-form-label text-lg-end col-lg-2 col-xl-3">Address</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" type="text" id="address" value="{{ old('address', optional($employee)->address) }}" minlength="1" placeholder="Enter address here...">
        {!! $errors->first('address', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="house_number" class="col-form-label text-lg-end col-lg-2 col-xl-3">House Number</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('house_number') ? ' is-invalid' : '' }}" name="house_number" type="number" id="house_number" value="{{ old('house_number', optional($employee)->house_number) }}" placeholder="Enter house number here...">
        {!! $errors->first('house_number', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="region_id" class="col-form-label text-lg-end col-lg-2 col-xl-3">Region</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-select{{ $errors->has('region_id') ? ' is-invalid' : '' }}" id="region_id" name="region_id">
        	    <option value="" style="display: none;" {{ old('region_id', optional($employee)->region_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select region</option>
        	@foreach ($regions as $key => $region)
			    <option value="{{ $key }}" {{ old('region_id', optional($employee)->region_id) == $key ? 'selected' : '' }}>
			    	{{ $region }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('region_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="zone_id" class="col-form-label text-lg-end col-lg-2 col-xl-3">Zone</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-select{{ $errors->has('zone_id') ? ' is-invalid' : '' }}" id="zone_id" name="zone_id">
        	    <option value="" style="display: none;" {{ old('zone_id', optional($employee)->zone_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select zone</option>
        	@foreach ($zones as $key => $zone)
			    <option value="{{ $key }}" {{ old('zone_id', optional($employee)->zone_id) == $key ? 'selected' : '' }}>
			    	{{ $zone }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('zone_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="woreda_id" class="col-form-label text-lg-end col-lg-2 col-xl-3">Woreda</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-select{{ $errors->has('woreda_id') ? ' is-invalid' : '' }}" id="woreda_id" name="woreda_id">
        	    <option value="" style="display: none;" {{ old('woreda_id', optional($employee)->woreda_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select woreda</option>
        	@foreach ($woredas as $key => $woreda)
			    <option value="{{ $key }}" {{ old('woreda_id', optional($employee)->woreda_id) == $key ? 'selected' : '' }}>
			    	{{ $woreda }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('woreda_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="status" class="col-form-label text-lg-end col-lg-2 col-xl-3">Status</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" type="text" id="status" value="{{ old('status', optional($employee)->status) }}" minlength="1" placeholder="Enter status here...">
        {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="id_issue_date" class="col-form-label text-lg-end col-lg-2 col-xl-3">Id Issue Date</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('id_issue_date') ? ' is-invalid' : '' }}" name="id_issue_date" type="text" id="id_issue_date" value="{{ old('id_issue_date', optional($employee)->id_issue_date) }}" placeholder="Enter id issue date here...">
        {!! $errors->first('id_issue_date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="id_expire_date" class="col-form-label text-lg-end col-lg-2 col-xl-3">Id Expire Date</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('id_expire_date') ? ' is-invalid' : '' }}" name="id_expire_date" type="text" id="id_expire_date" value="{{ old('id_expire_date', optional($employee)->id_expire_date) }}" placeholder="Enter id expire date here...">
        {!! $errors->first('id_expire_date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="id_status" class="col-form-label text-lg-end col-lg-2 col-xl-3">Id Status</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('id_status') ? ' is-invalid' : '' }}" name="id_status" type="text" id="id_status" value="{{ old('id_status', optional($employee)->id_status) }}" minlength="1" placeholder="Enter id status here...">
        {!! $errors->first('id_status', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

