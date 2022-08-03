<?php

namespace App\Http\Requests\Admin\Clients;

use Illuminate\Foundation\Http\FormRequest;

class ClientStoreFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email:rfc,dns',
            'email_verified_at' => 'nullable|date',
            'password' => 'required|string|min:6|confirmed',
        ];
    }
}
