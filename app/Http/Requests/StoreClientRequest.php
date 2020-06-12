<?php

namespace App\Http\Requests;

use App\Client;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreClientRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('client_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'passport_photo' => [
                'required',
            ],
            'first_name'     => [
                'required',
            ],
            'last_name'      => [
                'required',
            ],
            'id_number'      => [
                'required',
                'integer',
            ],
            'phone_number'   => [
                'required',
            ],
            'gender'         => [
                'required',
            ],
            'kra_pin'        => [
                'required',
                'max:10',
            ],
            'id_front'       => [
                'required',
            ],
            'id_back'        => [
                'required',
            ]
        ];
    }
}
