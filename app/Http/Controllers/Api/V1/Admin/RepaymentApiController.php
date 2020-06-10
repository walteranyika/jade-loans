<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRepaymentRequest;
use App\Http\Requests\UpdateRepaymentRequest;
use App\Http\Resources\Admin\RepaymentResource;
use App\Repayment;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RepaymentApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('repayment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RepaymentResource(Repayment::with(['client', 'loan', 'user'])->get());
    }

    public function store(StoreRepaymentRequest $request)
    {
        $repayment = Repayment::create($request->all());

        return (new RepaymentResource($repayment))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Repayment $repayment)
    {
        abort_if(Gate::denies('repayment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RepaymentResource($repayment->load(['client', 'loan', 'user']));
    }

    public function update(UpdateRepaymentRequest $request, Repayment $repayment)
    {
        $repayment->update($request->all());

        return (new RepaymentResource($repayment))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Repayment $repayment)
    {
        abort_if(Gate::denies('repayment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $repayment->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
