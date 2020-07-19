<?php

namespace App\Http\Requests\Api\Clients;

use App\Http\Requests\Api\ApiRequest;

/**
 * Class CreateClientRequest
 *
 * @package App\Http\Requests\Api\Clients
 */
class CreateClientRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'   => ['required'],
            'last_name'    => ['required'],
            'email_list'   => ['required', 'array'],
            'email_list.*' => ['email', 'unique:clients_emails,email'],
            'phone_list'   => ['required', 'array'],
            'phone_list.*' => ['unique:clients_phones,phone', 'regex:/^\+7\d{10}$/i'],
        ];
    }
}
