@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.fund.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.funds.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.fund.fields.id') }}
                        </th>
                        <td>
                            {{ $fund->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fund.fields.asset_name') }}
                        </th>
                        <td>
                            {{ $fund->asset_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fund.fields.asset_category') }}
                        </th>
                        <td>
                            {{ $fund->asset_category }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fund.fields.amount') }}
                        </th>
                        <td>
                            {{ $fund->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fund.fields.type') }}
                        </th>
                        <td>
                            {{ App\Fund::TYPE_RADIO[$fund->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fund.fields.made_by') }}
                        </th>
                        <td>
                            {{ App\Fund::MADE_BY_RADIO[$fund->made_by] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fund.fields.date') }}
                        </th>
                        <td>
                            {{ $fund->date }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.funds.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection