<?php

namespace App\Http\Requests;

use App\Fund;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreFundRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('fund_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'asset_name'     => [
                'required',
            ],
            'asset_category' => [
                'required',
            ],
            'amount'         => [
                'required',
            ],
            'type'           => [
                'required',
            ],
            'made_by'        => [
                'required',
            ],
            'date'           => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
