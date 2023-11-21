<?php

namespace App\Http\Validates\User\Users;


use App\Core\Validates;
use Domain\User\Entities\User;

/**
 * Class DeleteRequest.php
 *
 * @package App\Http\Validates\User\Users  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 28/10/2023
 */
class DeleteRequest extends Validates
{
    public function authorize(): bool
    {
        return request()->user()->can('delete', User::class);
    }

    public function rules(): array
    {
        return [

        ];
    }
}
