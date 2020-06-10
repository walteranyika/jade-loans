<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Client;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Resources\Admin\ClientResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('client_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ClientResource(Client::all());
    }

    public function store(StoreClientRequest $request)
    {
        $client = Client::create($request->all());

        if ($request->input('passport_photo', false)) {
            $client->addMedia(storage_path('tmp/uploads/' . $request->input('passport_photo')))->toMediaCollection('passport_photo');
        }

        if ($request->input('id_front', false)) {
            $client->addMedia(storage_path('tmp/uploads/' . $request->input('id_front')))->toMediaCollection('id_front');
        }

        if ($request->input('id_back', false)) {
            $client->addMedia(storage_path('tmp/uploads/' . $request->input('id_back')))->toMediaCollection('id_back');
        }

        return (new ClientResource($client))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Client $client)
    {
        abort_if(Gate::denies('client_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ClientResource($client);
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->update($request->all());

        if ($request->input('passport_photo', false)) {
            if (!$client->passport_photo || $request->input('passport_photo') !== $client->passport_photo->file_name) {
                $client->addMedia(storage_path('tmp/uploads/' . $request->input('passport_photo')))->toMediaCollection('passport_photo');
            }
        } elseif ($client->passport_photo) {
            $client->passport_photo->delete();
        }

        if ($request->input('id_front', false)) {
            if (!$client->id_front || $request->input('id_front') !== $client->id_front->file_name) {
                $client->addMedia(storage_path('tmp/uploads/' . $request->input('id_front')))->toMediaCollection('id_front');
            }
        } elseif ($client->id_front) {
            $client->id_front->delete();
        }

        if ($request->input('id_back', false)) {
            if (!$client->id_back || $request->input('id_back') !== $client->id_back->file_name) {
                $client->addMedia(storage_path('tmp/uploads/' . $request->input('id_back')))->toMediaCollection('id_back');
            }
        } elseif ($client->id_back) {
            $client->id_back->delete();
        }

        return (new ClientResource($client))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Client $client)
    {
        abort_if(Gate::denies('client_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $client->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
