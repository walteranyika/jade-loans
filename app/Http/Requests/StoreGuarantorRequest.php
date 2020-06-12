<?php

namespace App\Http\Requests;

use App\Guarantor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreGuarantorRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('guarantor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'first_name'   => [
                'required',
            ],
            'last_name'    => [
                'required',
            ],
            'idd_number'   => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'phone_number' => [
                'required',
            ],
            'id_number'    => [
                'required',
            ],
            'address'      => [
                'required',
            ],
        ];
    }
}
