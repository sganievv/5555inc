<?php

namespace Domain\Storehouse\Policies;


use App\Core\Policies;
use Domain\User\Entities\User;

/**
 * Class StorehousePolicy.php
 *
 * @package Domain\Storehouse\Policies  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 29/10/2023
 */
class StorehousePolicy extends Policies
{
    public function viewAny(User $user): bool
    {
        return in_array($user->getRole(), ['admin']);
    }

    public function edit(User $user): bool
    {
        return in_array($user->getRole(), ['admin']);
    }

    public function create(User $user): bool
    {
        return in_array($user->getRole(), ['admin']);
    }
}
