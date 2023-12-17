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

    public array $selectedTrackingNumbers = []; // Добавленная переменная



    public function addOrder()
    {
        $order = Order::query()
            ->selectWithQuantity()
            ->whereIsTaken(0)
            ->whereTrackingNumber($this->trackingNumber);

        if (request()->user()->getStorehouseId()) {
            $order = $order->whereStorehouseId(request()->user()->getStorehouseId());
        }

        $order = $order->first();

        if (!is_null($order)) {
            $this->items[] = [
                'order' => $order,
                'initialQuantity' => $order->getQuantity(), // Store the initial quantity
                'isRemaining' => $order->getInitialQuantity() != $order->getQuantity(),
                'trackingNumber' => $this->trackingNumber,
            ];

            // Обновим список выбранных номеров отслеживания
            $this->selectedTrackingNumbers[] = $this->trackingNumber;
        }
    }

    protected function calculateTotalAmount()
    {
        $this->totalAmount = 0.0;

        foreach ($this->items as $item) {
            // Прибавляем сумму только для товаров без надписи "Остаток"
            if (!$item['isRemaining']) {
                $this->totalAmount += $item['order']->getTotalAmount();
            }
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
        foreach ($this->items as $item) {
            // Добавляем проверку на null перед вызовом getTotalAmount()
            if ($item['order'] && method_exists($item['order'], 'getTotalAmount')) {
                // Прибавляем сумму только для товаров без надписи "Остаток"
                if (!$item['isRemaining']) {
                    $this->totalAmount += $item['order']->getTotalAmount();
                }
            }
        }

        return view('livewire.load-orders', [
            'orders' => $orders->get(),
        ]);
    }




}
