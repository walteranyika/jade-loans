<?php

namespace App\Http\Requests;

use App\Guarantor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateGuarantorRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('guarantor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
            ],
            'phone_number' => [
                'required',
            ],
            'id_back'      => [
                'required',
                'integer',
            ],
            'address'      => [
                'required',
            ]
        ];
    }
}
