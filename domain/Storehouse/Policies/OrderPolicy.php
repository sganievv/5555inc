<?php

namespace Domain\Storehouse\Policies;


use App\Core\Policies;
use Domain\User\Entities\User;

/**
 * Class OrderPolicy.php
 *
 * @package Domain\Storehouse\Policies  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 29/10/2023
 */
class OrderPolicy extends Policies
{
    public function viewAny(User $user): bool
    {
        return in_array($user->getRole(), ['admin', 'manager']);
    }

    public function edit(User $user): bool
    {
        return in_array($user->getRole(), ['admin', 'manager']);
    }

    public function create(User $user): bool
    {
        return $user->getRole() == 'manager' && $user->getStorehouseId() == 1;
    }
}
