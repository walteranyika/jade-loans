<?php

namespace App\Http\Requests;

use App\Repayment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateRepaymentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('repayment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'client_id'        => [
                'required',
                'integer',
            ],
            'loan_id'          => [
                'required',
                'integer',
            ],
            'repayment_date'   => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'repayment_amount' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'user_id'          => [
                'required',
                'integer',
            ],
        ];
    }
}
