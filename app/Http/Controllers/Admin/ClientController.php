<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyClientRequest;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ClientController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('client_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::all();

        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        abort_if(Gate::denies('client_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.clients.create');
    }

    public function store(StoreClientRequest $request)
    {
        $data=array_merge($request->all(),["application"=>1,"added_by"=>auth()->user()->name]);
        $client = Client::create($data);

        if ($request->input('passport_photo', false)) {
            $client->addMedia(storage_path('tmp/uploads/' . $request->input('passport_photo')))->toMediaCollection('passport_photo');
        }

        if ($request->input('id_front', false)) {
            $client->addMedia(storage_path('tmp/uploads/' . $request->input('id_front')))->toMediaCollection('id_front');
        }

        if ($request->input('id_back', false)) {
            $client->addMedia(storage_path('tmp/uploads/' . $request->input('id_back')))->toMediaCollection('id_back');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $client->id]);
        }

        return redirect()->route('admin.clients.index');
    }

    public function edit(Client $client)
    {
        abort_if(Gate::denies('client_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.clients.edit', compact('client'));
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        $data=array_merge($request->all(),["application"=>1,"added_by"=>auth()->user()->name]);

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

        return redirect()->route('admin.clients.index');
    }

    public function show(Client $client)
    {
        abort_if(Gate::denies('client_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $client->load('clientCredits');

        return view('admin.clients.show', compact('client'));
    }

    public function destroy(Client $client)
    {
        abort_if(Gate::denies('client_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $client->delete();

        return back();
    }

    public function massDestroy(MassDestroyClientRequest $request)
    {
        Client::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('client_create') && Gate::denies('client_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Client();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
