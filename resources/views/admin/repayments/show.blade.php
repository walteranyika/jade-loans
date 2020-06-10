@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.repayment.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.repayments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.repayment.fields.id') }}
                        </th>
                        <td>
                            {{ $repayment->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.repayment.fields.client') }}
                        </th>
                        <td>
                            {{ $repayment->client->first_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.repayment.fields.loan') }}
                        </th>
                        <td>
                            {{ $repayment->loan->amount ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.repayment.fields.repayment_date') }}
                        </th>
                        <td>
                            {{ $repayment->repayment_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.repayment.fields.repayment_amount') }}
                        </th>
                        <td>
                            {{ $repayment->repayment_amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.repayment.fields.user') }}
                        </th>
                        <td>
                            {{ $repayment->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.repayments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection