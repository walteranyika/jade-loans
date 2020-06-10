@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.guarantor.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.guarantors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.guarantor.fields.id') }}
                        </th>
                        <td>
                            {{ $guarantor->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.guarantor.fields.first_name') }}
                        </th>
                        <td>
                            {{ $guarantor->first_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.guarantor.fields.last_name') }}
                        </th>
                        <td>
                            {{ $guarantor->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.guarantor.fields.idd_number') }}
                        </th>
                        <td>
                            {{ $guarantor->idd_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.guarantor.fields.phone_number') }}
                        </th>
                        <td>
                            {{ $guarantor->phone_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.guarantor.fields.id_number') }}
                        </th>
                        <td>
                            @if($guarantor->id_number)
                                <a href="{{ $guarantor->id_number->getUrl() }}" target="_blank">
                                    <img src="{{ $guarantor->id_number->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.guarantor.fields.id_back') }}
                        </th>
                        <td>
                            {{ $guarantor->id_back }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.guarantor.fields.address') }}
                        </th>
                        <td>
                            {{ $guarantor->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.guarantor.fields.added_by') }}
                        </th>
                        <td>
                            {{ App\Guarantor::ADDED_BY_RADIO[$guarantor->added_by] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.guarantors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#guarantor_credits" role="tab" data-toggle="tab">
                {{ trans('cruds.credit.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="guarantor_credits">
            @includeIf('admin.guarantors.relationships.guarantorCredits', ['credits' => $guarantor->guarantorCredits])
        </div>
    </div>
</div>

@endsection