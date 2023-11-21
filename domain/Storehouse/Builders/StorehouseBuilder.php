<?php

namespace Domain\Storehouse\Builders;


use App\Core\Builders;

/**
 * Class StorehouseBuilder.php
 *
 * @package Domain\Storehouse\Builders  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 29/10/2023
 */
class StorehouseBuilder extends Builders
{
    public function whereId(int $id): StorehouseBuilder
    {
        return $this->where('id', '=', $id);
    }

    public function whereIds(array $ids): StorehouseBuilder
    {
        return $this->whereIn('id', $ids);
    }

    public function whereName(string $name): StorehouseBuilder
    {
        return $this->where('name', 'ilike', '%'.$name.'%');
    }

    public function whereAddress(string $address): StorehouseBuilder
    {
        return $this->where('address', 'ilike', '%'.$address.'%');
    }

    public function filterByParams(array $params): static
    {
        if(isset($params['id']))
            $this->whereId($params['id']);

        if(isset($params['name']))
            $this->whereName($params['name']);

        if(isset($params['address']))
            $this->whereAddress($params['address']);

        return $this;
    }
}
