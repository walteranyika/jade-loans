@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.credit.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.credits.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.credit.fields.id') }}
                        </th>
                        <td>
                            {{ $credit->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.credit.fields.client') }}
                        </th>
                        <td>
                            {{ $credit->client->first_name ?? '' }} {{ $credit->client->last_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.credit.fields.product') }}
                        </th>
                        <td>
                            {{ $credit->product->package_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.credit.fields.amount') }}
                        </th>
                        <td>
                            {{ $credit->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.credit.fields.guarantor') }}
                        </th>
                        <td>
                            {{ $credit->guarantor->first_name ?? '' }}  {{ $credit->guarantor->last_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.credit.fields.status') }}
                        </th>
                        <td>
                            {{ $credit->status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.credit.fields.user') }}
                        </th>
                        <td>
                            {{ $credit->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.credit.fields.date_issued') }}
                        </th>
                        <td>
                            {{ $credit->date_issued }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Last Date
                        </th>
                        <td>
                            {{ $credit->last_date->format('d/m/Y') }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.credit.fields.total_repayment') }}
                        </th>
                        <td>
                            {{ $credit->total_repayment }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.credit.fields.balance') }}
                        </th>
                        <td>
                            {{ $credit->balance }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.credit.fields.location') }}
                        </th>
                        <td>
                            {{ $credit->location->branch_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.credit.fields.mpesa_code') }}
                        </th>
                        <td>
                            {{ $credit->mpesa_code }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.credits.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
