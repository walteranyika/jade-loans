<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index(Product $product)
    {
        return response()->json($product);
    }

    public function getEndDate(Request $request)
    {
        $product = Product::find($request->loan_id);
        $start_date=str_replace("/","-",$request->date);
        $endDate= Carbon::parse($start_date)->addDays($product->duration+1);
        return $endDate->format("d-m-Y");
    }
}
