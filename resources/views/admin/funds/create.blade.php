@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.fund.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.funds.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="asset_name">{{ trans('cruds.fund.fields.asset_name') }}</label>
                <input class="form-control {{ $errors->has('asset_name') ? 'is-invalid' : '' }}" type="text" name="asset_name" id="asset_name" value="{{ old('asset_name', '') }}" required>
                @if($errors->has('asset_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('asset_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fund.fields.asset_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="asset_category">{{ trans('cruds.fund.fields.asset_category') }}</label>
                <input class="form-control {{ $errors->has('asset_category') ? 'is-invalid' : '' }}" type="text" name="asset_category" id="asset_category" value="{{ old('asset_category', 'capital') }}" required>
                @if($errors->has('asset_category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('asset_category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fund.fields.asset_category_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount">{{ trans('cruds.fund.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', '') }}" step="0.01" required>
                @if($errors->has('amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fund.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.fund.fields.type') }}</label>
                @foreach(App\Fund::TYPE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('type') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="type_{{ $key }}" name="type" value="{{ $key }}" {{ old('type', '') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="type_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fund.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.fund.fields.made_by') }}</label>
                @foreach(App\Fund::MADE_BY_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('made_by') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="made_by_{{ $key }}" name="made_by" value="{{ $key }}" {{ old('made_by', '') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="made_by_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('made_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('made_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fund.fields.made_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.fund.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}" required>
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fund.fields.date_helper') }}</span>
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