<?php

namespace App\Http\Controllers\Storehouse;


use App\Http\Controllers\DashboardController;
use App\Http\Validates\Storehouse\Storehouses\CreateRequest;
use App\Http\Validates\Storehouse\Storehouses\EditRequest;
use App\Http\Validates\Storehouse\Storehouses\IndexRequest;
use App\Http\Validates\Storehouse\Storehouses\StoreRequest;
use App\Http\Validates\Storehouse\Storehouses\UpdateRequest;
use Domain\Storehouse\Entities\Storehouse;
use Domain\Storehouse\Services\StorehouseService;

/**
 * Class StorehousesController.php
 *
 * @package App\Http\Controllers\Storehouse  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 29/10/2023
 */
class StorehousesController extends DashboardController
{
    public function __construct(Storehouse $storehouse, StorehouseService $storehouseService)
    {
        parent::__construct();

        $this->storehouse = $storehouse;
        $this->storehouseService = $storehouseService;
    }

    private Storehouse $storehouse;
    private StorehouseService $storehouseService;

    public function index(IndexRequest $request)
    {
        $params = $request->validated();

        $storehouses = $this->storehouse
            ->filterByParams($params)
            ->orderBy('id', 'desc')
            ->paginate(18);

        return view('pages.storehouse.storehouses.index', [
            'storehouses' => $storehouses,
        ]);
    }

    public function create(CreateRequest $request)
    {
        return view('pages.storehouse.storehouses.create');
    }

    public function store(StoreRequest $request)
    {
        $storehouse = $this->storehouseService->create($request->validated());

        return redirect()->route('storehouse.storehouses.index', $storehouse->getId());
    }

    public function edit(Storehouse $storehouse, EditRequest $request)
    {
        return view('pages.storehouse.storehouses.edit', [
            'storehouse' => $storehouse,
        ]);
    }

    public function update(Storehouse $storehouse, UpdateRequest $request)
    {
        $this->storehouseService->update($storehouse, $request->validated());

        return redirect()->route('storehouse.storehouses.index', $storehouse->getId());
    }

    public function release($id)
    {
        // Найдите запись о загрузке
        $load = Load::findOrFail($id);

        // Отпустите машину (ваша логика отпуска)
        // Например, вы можете изменить статус машины на "отпущена"

        // После отпуска перенаправьте пользователя на страницу с машинами
        return redirect()->route('storehouse.loads.index')->with('success', 'Машина успешно отпущена.');
    }

    public function change_state(Request $request, $orderId)
    {
        // Ваш код изменения состояния заказа

        return redirect()->route('cashier.index');
    }

}
