<?php

namespace App\Http\Validates\Storehouse\Loads;


use App\Core\Validates;
use Domain\Storehouse\Entities\Load;

/**
 * Class IndexRequest.php
 *
 * @package App\Http\Validates\Storehouse\Loads  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 30/10/2023
 */
class IndexRequest extends Validates
{
    public function authorize(): bool
    {
        return request()->user()->can('viewAny', Load::class);
    }

    public function rules(): array
    {
        return [
            'driver_id' => 'nullable|numeric',
            'car_id' => 'nullable|numeric',

            'storehouse_from_id' => 'nullable|numeric',
            'storehouse_to_id' => 'nullable|numeric',
        ];
    }
}
