<?php

namespace App\Http\Requests;

use App\Product;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
                'min:-2147483648',
                'max:2147483647',
            ],
            'created_by'   => [
                'required',
            ],
        ];
    }
}
