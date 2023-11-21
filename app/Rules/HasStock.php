<?php

namespace App\Rules;

use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\DataAwareRule;

class HasStock implements Rule, DataAwareRule
{
    /**
     * The data under validation.
     *
     * @var array
     */
    protected $requestData = [];


    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    /**
     * Make sure the product quantity requested
     * is available in stock.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $product = Product::findByUuid($value);

        return $this->requestData['quantity'] <= $product->stock_quantity;
    }


    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Requested quantity exceeds available stock.';
    }


    /**
     * @param array $data
     * @return HasStock|$this
     */
    public function setData($data): HasStock|static
    {
        $this->requestData = $data;

        return $this;
    }
}
