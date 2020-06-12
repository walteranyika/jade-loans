@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.client.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.clients.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.id') }}
                        </th>
                        <td>
                            {{ $client->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.passport_photo') }}
                        </th>
                        <td>
                            @if($client->passport_photo)
                                <a href="{{ $client->passport_photo->getUrl() }}" target="_blank">
                                    <img src="{{ $client->passport_photo->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.first_name') }}
                        </th>
                        <td>
                            {{ $client->first_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.last_name') }}
                        </th>
                        <td>
                            {{ $client->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.id_number') }}
                        </th>
                        <td>
                            {{ $client->id_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.phone_number') }}
                        </th>
                        <td>
                            {{ $client->phone_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.gender') }}
                        </th>
                        <td>
                            {{ App\Client::GENDER_RADIO[$client->gender] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.zone') }}
                        </th>
                        <td>
                            {{ $client->zone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.kra_pin') }}
                        </th>
                        <td>
                            {{ $client->kra_pin }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.postal_address') }}
                        </th>
                        <td>
                            {{ $client->postal_address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.email_address') }}
                        </th>
                        <td>
                            {{ $client->email_address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.occupation') }}
                        </th>
                        <td>
                            {{ $client->occupation }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.id_front') }}
                        </th>
                        <td>
                            @if($client->id_front)
                                <a href="{{ $client->id_front->getUrl() }}" target="_blank">
                                    <img src="{{ $client->id_front->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.id_back') }}
                        </th>
                        <td>
                            @if($client->id_back)
                                <a href="{{ $client->id_back->getUrl() }}" target="_blank">
                                    <img src="{{ $client->id_back->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.application') }}
                        </th>
                        <td>
                            {{ $client->clientCredits->count() }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.added_by') }}
                        </th>
                        <td>
                            {{$client->added_by }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.clients.index') }}">
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
            <a class="nav-link" href="#client_credits" role="tab" data-toggle="tab">
                {{ trans('cruds.credit.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="client_credits">
            @includeIf('admin.clients.relationships.clientCredits', ['credits' => $client->clientCredits])
        </div>
    </div>
</div>

@endsection
