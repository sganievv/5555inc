<?php

namespace App\Http\Controllers\Storehouse;


use App\Http\Controllers\DashboardController;
use App\Http\Validates\Storehouse\Orders\ArchiveRequest;
use App\Http\Validates\Storehouse\Orders\ChangeStateRequest;
use App\Http\Validates\Storehouse\Orders\CreateRequest;
use App\Http\Validates\Storehouse\Orders\EditRequest;
use App\Http\Validates\Storehouse\Orders\IndexRequest;
use App\Http\Validates\Storehouse\Orders\StoreRequest;
use App\Http\Validates\Storehouse\Orders\UpdateRequest;
use Domain\Storehouse\Entities\Order;
use Domain\Storehouse\Services\OrderService;

/**
 * Class OrdersController.php
 *
 * @package App\Http\Controllers\Storehouse  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 29/10/2023
 */
class OrdersController extends DashboardController
{
    public function __construct(Order $order, OrderService $orderService)
    {
        parent::__construct();

        $this->order = $order;
        $this->orderService = $orderService;
    }

    private Order $order;
    private OrderService $orderService;

    public function index(IndexRequest $request)
    {
        $params = $request->validated();

        $orders = $this->order
            ->withRelations(['relationStorehouse', 'relationUser'])
            ->selectWithQuantity()
            ->filterByParams($params)
            ->whereIsTaken(0)
            ->orderBy('id', 'desc')
            ->paginate(18);

        $totalAmount = $this->order
            ->selectWithQuantity()
            ->filterByParams($params)
            ->whereIsTaken(0)
            ->sum('total_amount');

        return view('pages.storehouse.orders.index', [
            'orders' => $orders,
            'totalAmount' => $totalAmount,
        ]);
    }

    public function archive(ArchiveRequest $request)
    {
        $params = $request->validated();

        $orders = $this->order
            ->withRelations(['relationStorehouse', 'relationUser'])
            ->selectWithQuantity('=', 0)
            ->filterByParams($params)
            ->orderBy('id', 'desc')
            ->paginate(18);

        return view('pages.storehouse.orders.archive', [
            'orders' => $orders,
        ]);
    }

    public function create(CreateRequest $request)
    {
        return view('pages.storehouse.orders.create');
    }

    public function store(StoreRequest $request)
    {
        $order = $this->orderService->create($request->validated());
        session()->flash('success', 'Добавлено!');

        return redirect()->route('storehouse.orders.create', $order->getId());

    }


    public function show(Order $order, EditRequest $request)
    {
        return view('pages.storehouse.orders.show', [
            'order' => $order,
        ]);
    }

    public function edit(Order $order, EditRequest $request)
    {
        return view('pages.storehouse.orders.edit', [
            'order' => $order,
        ]);
    }

    public function update(Order $order, UpdateRequest $request)
    {
        $this->orderService->update($order, $request->validated());

        return redirect()->route('storehouse.orders.edit', $order->getId());
    }

    public function change_state(Order $order, ChangeStateRequest $request)
    {
        $this->orderService->update($order, $request->validated());

        return redirect()->route('storehouse.orders.show', $order->getId());
    }
}
