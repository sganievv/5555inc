<?php

namespace App\Livewire;


use App\Core\Components;
use Domain\Storehouse\Entities\Order;

/**
 * Class LoadOrders.php
 *
 * @package App\Livewire  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 04/11/2023
 */
class LoadOrders extends Components
{
    public $items = [];
    public string $trackingNumber = 'tracking-number';
    public float $totalAmount = 0.0;

    public function deleteOrder($i){
        if(isset($this->items[$i]))
            unset($this->items[$i]);
    }

    public function addOrder()
    {
        $order = Order::query()
            ->selectWithQuantity()
            ->whereIsTaken(0)
            ->whereTrackingNumber($this->trackingNumber);

        if(request()->user()->getStorehouseId())
            $order = $order->whereStorehouseId(request()->user()->getStorehouseId());

        $order = $order->first();

        if(!is_null($order)){
            $this->items[$order->getId()] = $order;
        }
    }

    public function render()
    {
        $orders = Order::query()
            ->selectWithQuantity()
            ->whereIsTaken(0)
            ->filterByParams([]);

        if(request()->user()->getStorehouseId())
            $orders = $orders->whereStorehouseId(request()->user()->getStorehouseId());

        $this->totalAmount = 0.0;
        foreach ($this->items as $item){
            $this->totalAmount += $item->getTotalAmount();
        }

        return view('livewire.load-orders', [
            'orders' => $orders->get(),
        ]);
    }
}
