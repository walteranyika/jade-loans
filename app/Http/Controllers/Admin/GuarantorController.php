<?php

namespace App\Http\Controllers\Admin;

use App\Guarantor;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyGuarantorRequest;
use App\Http\Requests\StoreGuarantorRequest;
use App\Http\Requests\UpdateGuarantorRequest;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class GuarantorController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('guarantor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $guarantors = Guarantor::all();

        return view('admin.guarantors.index', compact('guarantors'));
    }

    public function create()
    {
        abort_if(Gate::denies('guarantor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.guarantors.create');
    }

    public function store(StoreGuarantorRequest $request)
    {
        $guarantor = Guarantor::create(array_merge($request->all(),['added_by'=>auth()->user()->name]));

        if ($request->input('id_number', false)) {
            $guarantor->addMedia(storage_path('tmp/uploads/' . $request->input('id_number')))->toMediaCollection('id_number');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $guarantor->id]);
        }

        return redirect()->route('admin.guarantors.index');
    }

    public function edit(Guarantor $guarantor)
    {
        abort_if(Gate::denies('guarantor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.guarantors.edit', compact('guarantor'));
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

        return redirect()->route('admin.guarantors.index');
    }

    public function show(Guarantor $guarantor)
    {
        abort_if(Gate::denies('guarantor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $guarantor->load('guarantorCredits');

        return view('admin.guarantors.show', compact('guarantor'));
    }

    public function destroy(Guarantor $guarantor)
    {
        abort_if(Gate::denies('guarantor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $guarantor->delete();

        return back();
    }

    public function massDestroy(MassDestroyGuarantorRequest $request)
    {
        Guarantor::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('guarantor_create') && Gate::denies('guarantor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Guarantor();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
