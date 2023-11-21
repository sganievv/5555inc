<?php

namespace App\Http\Validates\User\Users;


use App\Core\Validates;
use Domain\User\Entities\User;

/**
 * Class StoreRequest.php
 *
 * @package App\Http\Validates\User\Users  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 28/10/2023
 */
class StoreRequest extends Validates
{
    public function authorize(): bool
    {
        return request()->user()->can('create', User::class);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'login' => 'required|string',
            'phone_number' => 'required|string',
            'role' => 'required|string',
            'storehouse_id' => 'nullable|numeric',
            'password' => 'required|string',
            'password_confirm' => 'same:password',
        ];
    }
}
