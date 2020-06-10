<?php

namespace App\Http\Controllers\Admin;

use App\Fund;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFundRequest;
use App\Http\Requests\StoreFundRequest;
use App\Http\Requests\UpdateFundRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FundController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('fund_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $funds = Fund::all();

        return view('admin.funds.index', compact('funds'));
    }

    public function create()
    {
        abort_if(Gate::denies('fund_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.funds.create');
    }

    public function store(StoreFundRequest $request)
    {
        $fund = Fund::create($request->all());

        return redirect()->route('admin.funds.index');
    }

    public function edit(Fund $fund)
    {
        abort_if(Gate::denies('fund_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.funds.edit', compact('fund'));
    }

    public function update(UpdateFundRequest $request, Fund $fund)
    {
        $fund->update($request->all());

        return redirect()->route('admin.funds.index');
    }

    public function show(Fund $fund)
    {
        abort_if(Gate::denies('fund_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.funds.show', compact('fund'));
    }

    public function destroy(Fund $fund)
    {
        abort_if(Gate::denies('fund_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fund->delete();

        return back();
    }

    public function massDestroy(MassDestroyFundRequest $request)
    {
        Fund::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
