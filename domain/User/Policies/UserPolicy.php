<?php

namespace Domain\User\Policies;


use App\Core\Policies;
use Domain\User\Entities\User;

/**
 * Class UserPolicy.php
 *
 * @package Domain\User\Policies  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 28/10/2023
 */
class UserPolicy extends Policies
{
    public function viewAny(User $user): bool
    {
        return $user->getRole() == 'admin';
    }

    public function edit(User $user): bool
    {
        return $user->getRole() == 'admin';
    }

    public function create(User $user): bool
    {
        return $user->getRole() == 'admin';
    }

    public function delete(User $user): bool
    {
        return $user->getRole() == 'admin';
    }
}
