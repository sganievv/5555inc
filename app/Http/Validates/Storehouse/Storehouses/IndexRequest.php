<?php

namespace App\Http\Validates\Storehouse\Storehouses;


use App\Core\Validates;
use Domain\Storehouse\Entities\Storehouse;

/**
 * Class IndexRequest.php
 *
 * @package App\Http\Validates\Storehouse\Storehouses  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 29/10/2023
 */
class IndexRequest extends Validates
{
    public function authorize(): bool
    {
        return request()->user()->can('viewAny', Storehouse::class);
    }

    public function rules(): array
    {
        return [
            'id' => 'nullable|numeric',
            'name' => 'nullable|string',
            'address' => 'nullable|string',
        ];
    }
}
