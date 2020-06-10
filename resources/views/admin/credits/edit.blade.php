@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.credit.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.credits.update", [$credit->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="client_id">{{ trans('cruds.credit.fields.client') }}</label>
                <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id" required>
                    @foreach($clients as $id => $client)
                        <option value="{{ $id }}" {{ ($credit->client ? $credit->client->id : old('client_id')) == $id ? 'selected' : '' }}>{{ $client }}</option>
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
                    @foreach($products as  $product)
                        <option value="{{ $product->id }}" {{ ($credit->product ? $credit->product->id : old('product_id')) == $id ? 'selected' : '' }}>{{ $product->package_name.' '.$product->amount }}</option>
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
                        <option value="{{ $id }}" {{ ($credit->guarantor ? $credit->guarantor->id : old('guarantor_id')) == $id ? 'selected' : '' }}>{{ $guarantor }}</option>
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
                <label class="required" for="status">{{ trans('cruds.credit.fields.status') }}</label>
                <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="number" name="status" id="status" value="{{ old('status', $credit->status) }}" step="1" required>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.credit.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.credit.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ ($credit->user ? $credit->user->id : old('user_id')) == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.credit.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date_issued">{{ trans('cruds.credit.fields.date_issued') }}</label>
                <input class="form-control date {{ $errors->has('date_issued') ? 'is-invalid' : '' }}" type="text" name="date_issued" id="date_issued" value="{{ old('date_issued', $credit->date_issued) }}" required>
                @if($errors->has('date_issued'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_issued') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.credit.fields.date_issued_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="total_repayment">{{ trans('cruds.credit.fields.total_repayment') }}</label>
                <input class="form-control {{ $errors->has('total_repayment') ? 'is-invalid' : '' }}" type="number" name="total_repayment" id="total_repayment" value="{{ old('total_repayment', $credit->total_repayment) }}" step="1" required>
                @if($errors->has('total_repayment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total_repayment') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.credit.fields.total_repayment_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="balance">{{ trans('cruds.credit.fields.balance') }}</label>
                <input class="form-control {{ $errors->has('balance') ? 'is-invalid' : '' }}" type="number" name="balance" id="balance" value="{{ old('balance', $credit->balance) }}" step="1" required>
                @if($errors->has('balance'))
                    <div class="invalid-feedback">
                        {{ $errors->first('balance') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.credit.fields.balance_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="location_id">{{ trans('cruds.credit.fields.location') }}</label>
                <select class="form-control select2 {{ $errors->has('location') ? 'is-invalid' : '' }}" name="location_id" id="location_id" required>
                    @foreach($locations as $id => $location)
                        <option value="{{ $id }}" {{ ($credit->location ? $credit->location->id : old('location_id')) == $id ? 'selected' : '' }}>{{ $location }}</option>
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
                <input class="form-control {{ $errors->has('mpesa_code') ? 'is-invalid' : '' }}" type="text" name="mpesa_code" id="mpesa_code" value="{{ old('mpesa_code', $credit->mpesa_code) }}">
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
