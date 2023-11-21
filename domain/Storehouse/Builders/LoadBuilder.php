<?php

namespace Domain\Storehouse\Builders;


use App\Core\Builders;

/**
 * Class LoadBuilder.php
 *
 * @package Domain\Storehouse\Builders  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 30/10/2023
 */
class LoadBuilder extends Builders
{
    public function whereId(int $id): LoadBuilder
    {
        return $this->where('id', '=', $id);
    }

    public function whereDriverId(int $driverId): LoadBuilder
    {
        return $this->where('driver_id', '=', $driverId);
    }

    public function whereCarId(int $carId): LoadBuilder
    {
        return $this->where('car_id', '=', $carId);
    }

    public function whereStorehouseFromId(int $storehouseFromId): LoadBuilder
    {
        return $this->where('storehouse_from_id', '=', $storehouseFromId);
    }

    public function whereStorehouseToId(int $storehouseToId): LoadBuilder
    {
        return $this->where('storehouse_to_id', '=', $storehouseToId);
    }

    public function whereStorehouseId(int $storehouseId): LoadBuilder
    {
        return $this->where('storehouse_from_id', '=', $storehouseId)
            ->orWhere('storehouse_to_id', '=', $storehouseId);
    }

    public function withRelations(array $relations): LoadBuilder
    {
        return $this->with($relations);
    }

    public function filterByParams(array $params): static
    {
        if(isset($params['driver_id']))
            $this->whereDriverId($params['driver_id']);

        if(isset($params['car_id']))
            $this->whereCarId($params['car_id']);

        if(request()->user()->getStorehouseId())
            $this->whereStorehouseToId(request()->user()->getStorehouseId());

        if(isset($params['storehouse_from_id']))
            $this->whereStorehouseFromId($params['storehouse_from_id']);

        if(isset($params['storehouse_to_id']))
            $this->whereStorehouseToId($params['storehouse_to_id']);

        return $this;
    }
}
