<?php

namespace App\Http\Validates\Storehouse\Loads;


use App\Core\Validates;
use Domain\Storehouse\Entities\Load;

/**
 * Class StoreRequest.php
 *
 * @package App\Http\Validates\Storehouse\Loads  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 30/10/2023
 */
class StoreRequest extends Validates
{
    public function authorize(): bool
    {
        return request()->user()->can('create', Load::class);
    }

    public function rules(): array
    {
        return [
            'car' => 'required|string',

            'storehouse_from_id' => 'required|numeric',
            'storehouse_to_id' => 'required|numeric',

            'orders' => 'nullable|array',
        ];
    }
}
