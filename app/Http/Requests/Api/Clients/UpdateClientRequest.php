<?php

namespace App\Http\Requests\Api\Clients;

use App\Http\Requests\Api\ApiRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateClientRequest
 *
 * @package App\Http\Requests\Api\Clients
 */
class UpdateClientRequest extends ApiRequest
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
            'email_list.*' => [
                'email',
                Rule::unique('clients_emails', 'email')->ignore($this->route('client_id'), 'client_id'),
            ],
            'phone_list'   => ['required', 'array'],
            'phone_list.*' => [
                'regex:/^\+7\d{10}$/i',
                Rule::unique('clients_phones', 'phone')->ignore($this->route('client_id'), 'client_id'),
            ],
        ];
    }
}
