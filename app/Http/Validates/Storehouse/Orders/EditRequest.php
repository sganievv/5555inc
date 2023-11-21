<?php

namespace App\Http\Validates\Storehouse\Orders;


use App\Core\Validates;
use Domain\Storehouse\Entities\Order;

/**
 * Class EditRequest.php
 *
 * @package App\Http\Validates\Storehouse\Orders  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 29/10/2023
 */
class EditRequest extends Validates
{
    public function authorize(): bool
    {
        return request()->user()->can('edit', Order::class);
    }

    public function rules(): array
    {
        return [

        ];
    }
}
