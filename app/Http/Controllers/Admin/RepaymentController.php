<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\Credit;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRepaymentRequest;
use App\Http\Requests\StoreRepaymentRequest;
use App\Http\Requests\UpdateRepaymentRequest;
use App\Repayment;
use App\Tracker;
use App\User;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class RepaymentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('repayment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $repayments = Repayment::all();

        return view('admin.repayments.index', compact('repayments'));
    }

    public function create()
    {
        abort_if(Gate::denies('repayment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::all();

        $loans = Credit::all();

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.repayments.create', compact('clients', 'loans', 'users'));
    }

    public function store(StoreRepaymentRequest $request)
    {
        $repayment = Repayment::create(array_merge($request->all(), ['user_id'=>auth()->user()->id]));
        $loan =Credit::find($repayment->loan->id);
        $loan->total_repayment += $request->repayment_amount;
        $loan->balance -= $request->repayment_amount;
        $loan->save();

        //create a repayment

        $tracker = Tracker:://where(['credit_id'=>$loan->id])
                   where('payment_date','=',Carbon::parse(str_replace('/','-',$request->repayment_date))->format('Y-m-d'))
                   ->first();
        $tracker->paid=true;
        $tracker->save();

        if ($loan->balance<=0){
            $loan->status=1;
            $loan->save();
        }

        return redirect()->route('admin.repayments.index')->with('message','Repayment has been updated successfully');
    }

    public function edit(Repayment $repayment)
    {
        abort_if(Gate::denies('repayment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $loans = Credit::all()->pluck('amount', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $repayment->load('client', 'loan', 'user');

        return view('admin.repayments.edit', compact('clients', 'loans', 'users', 'repayment'));
    }

    public function update(UpdateRepaymentRequest $request, Repayment $repayment)
    {
        $repayment->update($request->all());

        return redirect()->route('admin.repayments.index');
    }

    public function show(Repayment $repayment)
    {
        abort_if(Gate::denies('repayment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $repayment->load('client', 'loan', 'user');

        return view('admin.repayments.show', compact('repayment'));
    }

    public function destroy(Repayment $repayment)
    {
        abort_if(Gate::denies('repayment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $repayment->delete();

        return back();
    }

    public function massDestroy(MassDestroyRepaymentRequest $request)
    {
        Repayment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
