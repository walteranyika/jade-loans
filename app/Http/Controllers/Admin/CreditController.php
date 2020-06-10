<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\Credit;
use App\Guarantor;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCreditRequest;
use App\Http\Requests\StoreCreditRequest;
use App\Http\Requests\UpdateCreditRequest;
use App\Location;
use App\Product;
use App\Tracker;
use App\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CreditController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('credit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $credits = Credit::all();

        return view('admin.credits.index', compact('credits'));
    }

    public function create()
    {
        abort_if(Gate::denies('credit_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::all();

        $guarantors = Guarantor::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $locations = Location::all()->pluck('branch_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.credits.create', compact('clients', 'products', 'guarantors', 'users', 'locations'));
    }

    public function store(StoreCreditRequest $request)
    {
        $amount = Product::find($request->product_id)->amount;
        $data = ['amount' => $amount, 'balance' => $amount, 'user_id' => auth()->user()->id, 'status' => 0, 'total_repayment' => 0];
        $credit = Credit::create(array_merge($request->all(), $data));
        $daily_amount = round($credit->product->amount / $credit->product->duration);
        $start = Carbon::now()->addDays(1);
        $end = Carbon::now()->addDays($credit->product->duration);
        $dates = CarbonPeriod::create($start, $end);
        $datey = [];
        foreach ($dates as $date) {
            $datey[] = $date->format('Y-m-d');
            Tracker::create(['credit_id' => $credit->id, 'payment_date' => $date, 'amount' => $daily_amount]);
        }
        return redirect()->route('admin.credits.index');
    }

    public function edit(Credit $credit)
    {
        abort_if(Gate::denies('credit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::all();

        $guarantors = Guarantor::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $locations = Location::all()->pluck('branch_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $credit->load('client', 'product', 'guarantor', 'user', 'location');

        return view('admin.credits.edit', compact('clients', 'products', 'guarantors', 'users', 'locations', 'credit'));
    }

    public function update(UpdateCreditRequest $request, Credit $credit)
    {
        $amount = Product::find($request->product_id)->amount;
        $data = ['amount' => $amount];
        $credit->update(array_merge($request->all(), $data));
        return redirect()->route('admin.credits.index');
    }

    public function show(Credit $credit)
    {
        abort_if(Gate::denies('credit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $credit->load('client', 'product', 'guarantor', 'user', 'location');

        return view('admin.credits.show', compact('credit'));
    }

    public function destroy(Credit $credit)
    {
        abort_if(Gate::denies('credit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $credit->delete();

        return back();
    }

    public function massDestroy(MassDestroyCreditRequest $request)
    {
        Credit::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
