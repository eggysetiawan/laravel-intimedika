<?php

namespace App\Rules;

use App\FixPriceOrder;
use Illuminate\Contracts\Validation\Rule;

class RepeatRule implements Rule
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
        $price = [];
        $request = $this->request;
        $orders = FixPriceOrder::whereIn('order_id', $this->request->id_order)->pluck('order_id')->all();
        $orders->each(function ($order, $i) use (&$value, &$price, &$request) {
            $price = $request->price[$order->id];
        });
        dd($price);
        return isset($price);
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
