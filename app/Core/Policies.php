<?php

namespace App\Core;

use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class Policies.php
 *
 * @package App\Core  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 28/10/2023
 */
abstract class Policies
{
    use HandlesAuthorization;

    public function __construct()
    {
    }
}
