<?php

namespace App\Http\Requests;

use App\Credit;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateCreditRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('credit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'client_id'       => [
                'required',
                'integer',
            ],
            'product_id'      => [
                'required',
                'integer',
            ],
            'guarantor_id'    => [
                'required',
                'integer',
            ],
            'date_issued'     => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'location_id'     => [
                'required',
                'integer',
            ],
        ];
    }
}
