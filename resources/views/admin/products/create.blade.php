@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.product.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.products.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="package_name">{{ trans('cruds.product.fields.package_name') }}</label>
                <input class="form-control {{ $errors->has('package_name') ? 'is-invalid' : '' }}" type="text" name="package_name" id="package_name" value="{{ old('package_name', '') }}" required>
                @if($errors->has('package_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('package_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.package_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount">{{ trans('cruds.product.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', '') }}" step="0.01" required>
                @if($errors->has('amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="deposit">{{ trans('cruds.product.fields.deposit') }}</label>
                <input class="form-control {{ $errors->has('deposit') ? 'is-invalid' : '' }}" type="number" name="deposit" id="deposit" value="{{ old('deposit', '') }}" step="0.01" required>
                @if($errors->has('deposit'))
                    <div class="invalid-feedback">
                        {{ $errors->first('deposit') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.deposit_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="duration">{{ trans('cruds.product.fields.duration') }}</label>
                <input class="form-control {{ $errors->has('duration') ? 'is-invalid' : '' }}" type="number" name="duration" id="duration" value="{{ old('duration', '') }}" step="1" required>
                @if($errors->has('duration'))
                    <div class="invalid-feedback">
                        {{ $errors->first('duration') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.duration_helper') }}</span>
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
