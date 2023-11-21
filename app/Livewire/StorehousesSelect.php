<?php

namespace App\Livewire;


use App\Core\Components;
use Domain\Storehouse\Entities\Storehouse;

/**
 * Class StorehousesSelect.php
 *
 * @package App\Livewire  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 29/10/2023
 */
class StorehousesSelect extends Components
{
    public string $atrName;
    public int $selectedId = 0;
    public bool $isAdmin = false;

    public function render()
    {
        $storehouses = Storehouse::query()
            ->filterByParams([])
            ->get();

        if(request()->user()->getRole() == 'admin')
            $this->isAdmin = true;

        return view('livewire.storehouses-select', compact('storehouses'));
    }
}
