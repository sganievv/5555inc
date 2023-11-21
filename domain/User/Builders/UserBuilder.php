<?php

namespace Domain\User\Builders;


use App\Core\Builders;

/**
 * Class UserBuilder.php
 *
 * @package Domain\User\Builders  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 28/10/2023
 */
class UserBuilder extends Builders
{
    public function whereName(string $name): UserBuilder
    {
        return $this->where('name', 'ilike', '%'.$name.'%');
    }

    public function wherePhoneNumber(string $phoneNumber): UserBuilder
    {
        return $this->where('phone_number', 'ilike', '%'.$phoneNumber.'%');
    }

    public function whereRole(string $role): UserBuilder
    {
        return $this->where('role', '=', $role);
    }

    public function filterByParams(array $params): static
    {
        if(isset($params['name']))
            $this->whereName($params['name']);

        if(isset($params['phone_number']))
            $this->wherePhoneNumber($params['phone_number']);

        if(isset($params['role']))
            $this->whereRole($params['role']);

        return $this;
    }
}
