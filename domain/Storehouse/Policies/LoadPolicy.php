<?php

namespace Domain\Storehouse\Policies;


use App\Core\Policies;
use Domain\User\Entities\User;

/**
 * Class LoadPolicy.php
 *
 * @package Domain\Storehouse\Policies  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 30/10/2023
 */
class LoadPolicy extends Policies
{
    public function viewAny(User $user): bool
    {
        return in_array($user->getRole(), ['admin', 'manager']);
    }

    public function edit(User $user): bool
    {
        return in_array($user->getRole(), ['admin', 'manager']);
    }

    public function accept(User $user): bool
    {
        return $user->getRole() == 'manager' && ($user->getStorehouseId() == 2 || $user->getStorehouseId() == 3);
    }

    public function create(User $user): bool
    {
        return $user->getRole() == 'manager' && ($user->getStorehouseId() == 1 || $user->getStorehouseId() == 2);
    }
}
