@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.credit.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.credits.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="client_id">{{ trans('cruds.credit.fields.client') }}</label>
                <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id" required>
                    @foreach($clients as $id => $client)
                        <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}>{{ $client }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.credit.fields.client_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="product_id">{{ trans('cruds.credit.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id" required>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>{{ $product->package_name.' '.$product->amount }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.credit.fields.product_helper') }}</span>
            </div>


            <div class="form-group">
                <label class="required" for="guarantor_id">{{ trans('cruds.credit.fields.guarantor') }}</label>
                <select class="form-control select2 {{ $errors->has('guarantor') ? 'is-invalid' : '' }}" name="guarantor_id" id="guarantor_id" required>
                    @foreach($guarantors as $id => $guarantor)
                        <option value="{{ $id }}" {{ old('guarantor_id') == $id ? 'selected' : '' }}>{{ $guarantor }}</option>
                    @endforeach
                </select>
                @if($errors->has('guarantor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('guarantor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.credit.fields.guarantor_helper') }}</span>
            </div>


            <div class="form-group">
                <label class="required" for="date_issued">{{ trans('cruds.credit.fields.date_issued') }}</label>
                <input class="form-control date {{ $errors->has('date_issued') ? 'is-invalid' : '' }}" type="text" name="date_issued" id="date_issued" value="{{ old('date_issued') }}" required>
                @if($errors->has('date_issued'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_issued') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.credit.fields.date_issued_helper') }}</span>
            </div>


            <div class="form-group">
                <label class="required" for="location_id">{{ trans('cruds.credit.fields.location') }}</label>
                <select class="form-control select2 {{ $errors->has('location') ? 'is-invalid' : '' }}" name="location_id" id="location_id" required>
                    @foreach($locations as $id => $location)
                        <option value="{{ $id }}" {{ old('location_id') == $id ? 'selected' : '' }}>{{ $location }}</option>
                    @endforeach
                </select>
                @if($errors->has('location'))
                    <div class="invalid-feedback">
                        {{ $errors->first('location') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.credit.fields.location_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mpesa_code">{{ trans('cruds.credit.fields.mpesa_code') }}</label>
                <input class="form-control {{ $errors->has('mpesa_code') ? 'is-invalid' : '' }}" type="text" name="mpesa_code" id="mpesa_code" value="{{ old('mpesa_code', '') }}">
                @if($errors->has('mpesa_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mpesa_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.credit.fields.mpesa_code_helper') }}</span>
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
