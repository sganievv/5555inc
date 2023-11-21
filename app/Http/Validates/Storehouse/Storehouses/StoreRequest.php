<?php

namespace App\Http\Validates\Storehouse\Storehouses;


use App\Core\Validates;
use Domain\Storehouse\Entities\Storehouse;

/**
 * Class StoreRequest.php
 *
 * @package App\Http\Validates\Storehouse\Storehouses  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 29/10/2023
 */
class StoreRequest extends Validates
{
    public function authorize(): bool
    {
        return request()->user()->can('create', Storehouse::class);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'address' => 'required|string'
        ];
    }
}
