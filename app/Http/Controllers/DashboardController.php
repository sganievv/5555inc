<?php

namespace App\Http\Controllers;


/**
 * Class DashboardController.php
 *
 * @package App\Http\Controllers  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 28/10/2023
 */
class DashboardController extends Controller
{
    public function __construct()
    {
        app()->setLocale('ru');
    }
}
