<?php

namespace App\Http\Requests;

use App\Product;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'package_name' => [
                'required',
            ],
            'amount'       => [
                'required',
            ],
            'deposit'      => [
                'required',
            ],
            'duration'     => [
                'required',
                'integer',
                'min:1',
                'max:1000',
            ],
        ];
    }
}
