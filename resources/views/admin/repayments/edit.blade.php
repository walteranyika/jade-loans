@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.repayment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.repayments.update", [$repayment->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="client_id">{{ trans('cruds.repayment.fields.client') }}</label>
                <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id" required>
                    @foreach($clients as $id => $client)
                        <option value="{{ $id }}" {{ ($repayment->client ? $repayment->client->id : old('client_id')) == $id ? 'selected' : '' }}>{{ $client }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.repayment.fields.client_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="loan_id">{{ trans('cruds.repayment.fields.loan') }}</label>
                <select class="form-control select2 {{ $errors->has('loan') ? 'is-invalid' : '' }}" name="loan_id" id="loan_id" required>
                    @foreach($loans as $id => $loan)
                        <option value="{{ $id }}" {{ ($repayment->loan ? $repayment->loan->id : old('loan_id')) == $id ? 'selected' : '' }}>{{ $loan }}</option>
                    @endforeach
                </select>
                @if($errors->has('loan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('loan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.repayment.fields.loan_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="repayment_date">{{ trans('cruds.repayment.fields.repayment_date') }}</label>
                <input class="form-control date {{ $errors->has('repayment_date') ? 'is-invalid' : '' }}" type="text" name="repayment_date" id="repayment_date" value="{{ old('repayment_date', $repayment->repayment_date) }}" required>
                @if($errors->has('repayment_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('repayment_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.repayment.fields.repayment_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="repayment_amount">{{ trans('cruds.repayment.fields.repayment_amount') }}</label>
                <input class="form-control {{ $errors->has('repayment_amount') ? 'is-invalid' : '' }}" type="number" name="repayment_amount" id="repayment_amount" value="{{ old('repayment_amount', $repayment->repayment_amount) }}" step="1" required>
                @if($errors->has('repayment_amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('repayment_amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.repayment.fields.repayment_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.repayment.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ ($repayment->user ? $repayment->user->id : old('user_id')) == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.repayment.fields.user_helper') }}</span>
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