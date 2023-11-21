<?php

namespace App\Http\Requests;

use App\Rules\CartIsNotEmpty;

class ApplyDiscountRequest extends ApiRequest
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
            'coupon'   => ['required', 'exists:coupons,code'],
        ];
    }
}
