<?php

namespace App\Http\Requests;

use App\Rules\CartIsNotEmpty;

class CheckoutOrderRequest extends ApiRequest
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
            'cart_id'  => ['required', 'exists:carts,uuid', 'bail', new CartIsNotEmpty()],
            'name'     => ['required', ],
            'email'    => ['required', 'email'],
            'address'  => ['required', ],
            'username' => ['required_with_all:password', 'unique:users,username'],
            'password' => ['sometimes', 'confirmed'],
        ];
    }
}
