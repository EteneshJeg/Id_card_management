
<div class="mb-3 row">
    <label for="type" class="col-form-label text-lg-end col-lg-2 col-xl-3">Type</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" type="text" id="type" value="{{ old('type', optional($identityCardTemplate)->type) }}" minlength="1" placeholder="Enter type here...">
        {!! $errors->first('type', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="file" class="col-form-label text-lg-end col-lg-2 col-xl-3">File</label>
    <div class="col-lg-10 col-xl-9">
        <div class="mb-3">
            <input class="form-control{{ $errors->has('file') ? ' is-invalid' : '' }}" type="file" name="file" id="file" class="">
        </div>

        @if (isset($identityCardTemplate->file) && !empty($identityCardTemplate->file))

        <div class="input-group mb-3">
          <div class="form-check">
            <input type="checkbox" name="custom_delete_file" id="custom_delete_file" class="form-check-input custom-delete-file" value="1" {{ old('custom_delete_file', '0') == '1' ? 'checked' : '' }}> 
          </div>
          <label class="form-check-label" for="custom_delete_file"> Delete {{ $identityCardTemplate->file }}</label>
        </div>

        @endif

        {!! $errors->first('file', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="sample_file" class="col-form-label text-lg-end col-lg-2 col-xl-3">Sample File</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('sample_file') ? ' is-invalid' : '' }}" name="sample_file" type="text" id="sample_file" value="{{ old('sample_file', optional($identityCardTemplate)->sample_file) }}" minlength="1" placeholder="Enter sample file here...">
        {!! $errors->first('sample_file', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="status" class="col-form-label text-lg-end col-lg-2 col-xl-3">Status</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" type="text" id="status" value="{{ old('status', optional($identityCardTemplate)->status) }}" minlength="1" placeholder="Enter status here...">
        {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

