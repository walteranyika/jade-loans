<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Credit;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCreditRequest;
use App\Http\Requests\UpdateCreditRequest;
use App\Http\Resources\Admin\CreditResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CreditApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('credit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CreditResource(Credit::with(['client', 'product', 'guarantor', 'user', 'location'])->get());
    }

    public function store(StoreCreditRequest $request)
    {
        $credit = Credit::create($request->all());

        return (new CreditResource($credit))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Credit $credit)
    {
        abort_if(Gate::denies('credit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CreditResource($credit->load(['client', 'product', 'guarantor', 'user', 'location']));
    }

    public function update(UpdateCreditRequest $request, Credit $credit)
    {
        $credit->update($request->all());

        return (new CreditResource($credit))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Credit $credit)
    {
        abort_if(Gate::denies('credit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $credit->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
