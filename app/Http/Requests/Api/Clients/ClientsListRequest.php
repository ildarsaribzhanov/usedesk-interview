<?php

namespace App\Http\Requests\Api\Clients;

use App\Http\Requests\Api\ApiRequest;

/**
 * Class ClientsListRequest
 *
 * @package App\Http\Requests\Clients
 */
class ClientsListRequest extends ApiRequest
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
            'page'       => ['integer', 'min:1'],
            'limit'      => ['integer', 'min:1'],
            'search_by'  => ['in:all,name,phone,email'],
            'search_str' => ['required_with:search_by'],
        ];
    }
}
