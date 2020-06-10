<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Fund;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFundRequest;
use App\Http\Requests\UpdateFundRequest;
use App\Http\Resources\Admin\FundResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FundApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('fund_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FundResource(Fund::all());
    }

    public function store(StoreFundRequest $request)
    {
        $fund = Fund::create($request->all());

        return (new FundResource($fund))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Fund $fund)
    {
        abort_if(Gate::denies('fund_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FundResource($fund);
    }

    public function update(UpdateFundRequest $request, Fund $fund)
    {
        $fund->update($request->all());

        return (new FundResource($fund))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Fund $fund)
    {
        abort_if(Gate::denies('fund_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fund->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
