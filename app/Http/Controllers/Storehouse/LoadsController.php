<?php

namespace App\Http\Controllers\Storehouse;


use App\Http\Controllers\DashboardController;
use App\Http\Validates\Storehouse\Loads\AcceptOrderRequest;
use App\Http\Validates\Storehouse\Loads\CreateRequest;
use App\Http\Validates\Storehouse\Loads\EditRequest;
use App\Http\Validates\Storehouse\Loads\IndexRequest;
use App\Http\Validates\Storehouse\Loads\ShowRequest;
use App\Http\Validates\Storehouse\Loads\StoreRequest;
use App\Http\Validates\Storehouse\Loads\UpdateRequest;
use App\Http\Validates\User\Users\DeleteRequest;
use Domain\Storehouse\Entities\Load;
use Domain\Storehouse\Entities\LoadOrder;
use Domain\Storehouse\Entities\Order;
use Domain\Storehouse\Entities\Storehouse;
use Domain\Storehouse\Services\LoadOrderService;
use Domain\Storehouse\Services\LoadService;
use Domain\Storehouse\Services\OrderService;
use Domain\User\Entities\User;

/**
 * Class LoadsController.php
 *
 * @package App\Http\Controllers\Storehouse  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 30/10/2023
 */
class LoadsController extends DashboardController
{
    public function __construct(Load $load, LoadService $loadService, Order $order, OrderService $orderService, LoadOrderService $loadOrderService)
    {
        parent::__construct();

        $this->load = $load;
        $this->loadService = $loadService;
        $this->order = $order;
        $this->orderService = $orderService;
        $this->loadOrderService = $loadOrderService;
    }

    private Load $load;
    private LoadService $loadService;
    private Order $order;
    private OrderService $orderService;
    private LoadOrderService $loadOrderService;

    public function index(IndexRequest $request)
    {
        $params = $request->validated();

        $loads = $this->load
            ->withRelations(['relationStorehouseFrom', 'relationStorehouseTo'])
            ->filterByParams($params)
            ->orderBy('id', 'desc')
            ->paginate(18);

        return view('pages.storehouse.loads.index', [
            'loads' => $loads,

        ]);
    }


    public function create(CreateRequest $request)
    {
        return view('pages.storehouse.loads.create');
    }

    public function store(StoreRequest $request)
    {
        $load = $this->loadService->create($request->validated());
        session()->flash('success', 'Отгруженно!');

        return redirect()->route('storehouse.loads.create', $load->getId());
    }

    public function show(Load $load, ShowRequest $request)
    {
        return view('pages.storehouse.loads.show', [
            'load' => $load,
        ]);
    }

    public function edit(Load $load, EditRequest $request)
    {
        $loadOrders = $load->relationOrders
            ->mapWithKeys(function ($item){
                return [$item->getOrderId() => $item];
            });

        $orders = $this->order
            ->whereIds($loadOrders->pluck('order_id')->toArray())
            ->get();

        $items = [];
        foreach ($orders as $order) {
            $items[$order->getId()] = $order;
            $items[$order->getId()]['quantity'] = $loadOrders[$order->getId()]->getQuantity();
        }

        return view('pages.storehouse.loads.edit', [
            'load' => $load,
            'items' => $items
        ]);
    }

    public function update(Load $load, UpdateRequest $request)
    {
        $load = $this->loadService->update($load, $request->validated());

        return redirect()->route('storehouse.loads.edit', $load->getId());
    }

    public function accept_order(LoadOrder $loadOrder, AcceptOrderRequest $request)
    {
        $load = $loadOrder->relationLoad;

        $order = $this->order
            ->whereTrackingNumber($loadOrder->getTrackingNumber())
            ->whereStorehouseId($load->getStorehouseToId())
            ->first();

        if(is_null($order)){
            $order = $loadOrder->relationOrder;

            $orderData = [
                'tracking_number' => $loadOrder->getTrackingNumber(),
                'user_id' => $order->getUserId(),
                'storehouse_id' => $load->getStorehouseToId(),

                'client_name' => $order->getClientName(),
                'client_city' => $order->getClientCity(),
                'client_number' => $order->getClientNumber(),

                'name' => $order->getName(),
                'quantity' => $loadOrder->getQuantity(),
                'weight' => $order->getWeight(),
                'unit' => $order->getUnit(),
                'price' => $order->getPrice(),
                'total_amount' => $order->getTotalAmount(),
                'is_taken' => $order->getIsTaken(),
                'comments' => $order->getComments(),
            ];

            $this->orderService->create($orderData);
        }else{
            $this->orderService->update($order, [
                'quantity' => $order->getQuantity() + $loadOrder->getQuantity(),
            ]);
        }

        $this->loadOrderService->update($loadOrder, $request->validated());

        return redirect()->back();
    }
    public function release(Load $load)
    {
        // Проверяем, имеет ли пользователь право на отпуск машины
        if (auth()->check() && auth()->user()->storehouse_id != 1) {
            // Удаляем машину из списка
            $load->delete();
            session()->flash('success', 'Машина успешно отпущена!');
        } else {
            session()->flash('error', 'Недостаточно прав для отпуска машины.');
        }

        return redirect()->route('storehouse.loads.index');
    }
}
