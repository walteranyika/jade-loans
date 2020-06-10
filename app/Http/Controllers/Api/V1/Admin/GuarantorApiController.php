<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Guarantor;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreGuarantorRequest;
use App\Http\Requests\UpdateGuarantorRequest;
use App\Http\Resources\Admin\GuarantorResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GuarantorApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('guarantor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GuarantorResource(Guarantor::all());
    }

    public function store(StoreGuarantorRequest $request)
    {
        $guarantor = Guarantor::create($request->all());

        if ($request->input('id_number', false)) {
            $guarantor->addMedia(storage_path('tmp/uploads/' . $request->input('id_number')))->toMediaCollection('id_number');
        }

        return (new GuarantorResource($guarantor))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Guarantor $guarantor)
    {
        abort_if(Gate::denies('guarantor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GuarantorResource($guarantor);
    }

    public function update(UpdateGuarantorRequest $request, Guarantor $guarantor)
    {
        $guarantor->update($request->all());

        if ($request->input('id_number', false)) {
            if (!$guarantor->id_number || $request->input('id_number') !== $guarantor->id_number->file_name) {
                $guarantor->addMedia(storage_path('tmp/uploads/' . $request->input('id_number')))->toMediaCollection('id_number');
            }
        } elseif ($guarantor->id_number) {
            $guarantor->id_number->delete();
        }

        return (new GuarantorResource($guarantor))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Guarantor $guarantor)
    {
        abort_if(Gate::denies('guarantor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $guarantor->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
