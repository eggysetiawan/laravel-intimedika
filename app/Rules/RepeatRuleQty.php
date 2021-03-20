<?php

namespace App\Rules;

use App\FixPriceOrder;
use Illuminate\Contracts\Validation\Rule;

class RepeatRuleQty implements Rule
{
    public $request;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $qty = [];
        $orders = FixPriceOrder::whereIn('order_id', $this->request->id_order)->pluck('order_id')->all();
        $orders->each(function ($order, $i) use (&$value, &$qty) {
            $qty = $value[$order->id];
        });

        return isset($qty);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
