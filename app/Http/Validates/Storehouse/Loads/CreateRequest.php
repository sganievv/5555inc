<?php

namespace App\Http\Validates\Storehouse\Loads;


use App\Core\Validates;
use Domain\Storehouse\Entities\Load;

/**
 * Class CreateRequest.php
 *
 * @package App\Http\Validates\Storehouse\Loads  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 30/10/2023
 */
class CreateRequest extends Validates
{
    public function authorize(): bool
    {
        return request()->user()->can('create', Load::class);
    }

    public function rules(): array
    {
        return [

        ];
    }
}
