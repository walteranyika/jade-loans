@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.location.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.locations.update", [$location->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="branch_name">{{ trans('cruds.location.fields.branch_name') }}</label>
                <input class="form-control {{ $errors->has('branch_name') ? 'is-invalid' : '' }}" type="text" name="branch_name" id="branch_name" value="{{ old('branch_name', $location->branch_name) }}" required>
                @if($errors->has('branch_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('branch_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.location.fields.branch_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="branch_location">{{ trans('cruds.location.fields.branch_location') }}</label>
                <input class="form-control {{ $errors->has('branch_location') ? 'is-invalid' : '' }}" type="text" name="branch_location" id="branch_location" value="{{ old('branch_location', $location->branch_location) }}" required>
                @if($errors->has('branch_location'))
                    <div class="invalid-feedback">
                        {{ $errors->first('branch_location') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.location.fields.branch_location_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection