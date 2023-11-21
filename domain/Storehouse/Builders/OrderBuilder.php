<?php

namespace Domain\Storehouse\Builders;


use App\Core\Builders;
use Domain\Storehouse\Entities\LoadOrder;

/**
 * Class OrderBuilder.php
 *
 * @package Domain\Storehouse\Builders  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 29/10/2023
 */
class OrderBuilder extends Builders
{
    public function whereId(int $id): OrderBuilder
    {
        return $this->where('id', '=', $id);
    }

    public function whereIds(array $ids): OrderBuilder
    {
        return $this->whereIn('id', $ids);
    }

    public function whereStorehouseId(int $storehouseId): OrderBuilder
    {
        return $this->where('storehouse_id', '=', $storehouseId);
    }

    public function whereName(string $name): OrderBuilder
    {
        return $this->where('name', 'ilike', '%'.$name.'%');
    }

    public function whereIsTaken(int $isTaken = 0): OrderBuilder
    {
        return $this->where('is_taken', '=', $isTaken);
    }

    public function withRelations(array $relations): OrderBuilder
    {
        return $this->with($relations);
    }

    public function filterByParams(array $params): static
    {
        if(isset($params['id']))
            $this->whereId($params['id']);

        if(isset($params['storehouse_id']))
            $this->whereStorehouseId($params['storehouse_id']);

        if(isset($params['name']))
            $this->whereName($params['name']);

        if(request()->user()->getStorehouseId())
            $this->whereStorehouseId(request()->user()->getStorehouseId());

        return $this;
    }

    public function selectWithQuantity(string $sign = '>', float $quantity = 0.0): OrderBuilder
    {
        $loadOrders = LoadOrder::query()
            ->groupBy('order_id')
            ->selectRaw('
                order_id,
                SUM(quantity) as total
            ');

        return $this
            ->leftJoinSub($loadOrders, 'load_orders', 'orders.id', '=', 'load_orders.order_id')
            ->selectRaw('
                orders.id,
                orders.tracking_number,
                orders.user_id,
                orders.storehouse_id,
                orders.client_name,
                orders.client_city,
                orders.client_number,
                orders.name,
                COALESCE(orders.quantity - load_orders.total, orders.quantity) as quantity,
                orders.quantity as initial_quantity,
                orders.weight,
                orders.unit,
                orders.price,
                orders.total_amount,
                orders.is_taken,
                orders.comments
            ')
            ->whereRaw(sprintf('COALESCE(orders.quantity - load_orders.total, orders.quantity) %s  %s', $sign, $quantity));
    }
}
