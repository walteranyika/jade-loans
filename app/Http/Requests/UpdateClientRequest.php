<?php

namespace App\Http\Requests;

use App\Client;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateClientRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('client_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
            'id_number'    => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'phone_number' => [
                'required',
            ],
            'gender'       => [
                'required',
            ],
            'zone'         => [
                'required',
            ],
            'kra_pin'      => [
                'max:10',
            ],
            'application'  => [
                'required',
            ],
            'added_by'     => [
                'required',
            ],
        ];
    }
}
