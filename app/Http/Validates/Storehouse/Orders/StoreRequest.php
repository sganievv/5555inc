<?php

namespace App\Http\Validates\Storehouse\Orders;


use App\Core\Validates;
use Domain\Storehouse\Entities\Order;

/**
 * Class StoreRequest.php
 *
 * @package App\Http\Validates\Storehouse\Orders  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 29/10/2023
 */
class StoreRequest extends Validates
{
    public function authorize(): bool
    {
        return request()->user()->can('create', Order::class);
    }

    public function rules(): array
    {
        return [
            'client_name' => 'required|string',
            'client_city' => 'required|string',
            'client_number' => 'required|string',

            'name' => 'required|string',
            'quantity' => 'required|numeric',
            'weight' => 'required|numeric',
            'unit' => 'required|string',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/' ,
            'comments' => 'nullable|string',
            'total_amount' => 'required|numeric',
        ];
    }
}
