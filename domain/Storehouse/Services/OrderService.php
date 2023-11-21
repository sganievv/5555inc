<?php

namespace Domain\Storehouse\Services;


use App\Core\Services;
use Domain\Storehouse\Entities\Order;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class OrderService.php
 *
 * @package Domain\Storehouse\Services  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 29/10/2023
 */
class OrderService extends Services
{
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    private Order $order;

    /**
     * @throws Exception
     */
    public function create(array $data): Order
    {
        $data = collect($data);

        try{
            DB::beginTransaction();

            if(!isset($data['tracking_number']))
                $data['tracking_number'] = preg_replace('/^(\d)(\w{4})(\w{4})(\w+)$/', '$1-$2-$3-$4', uniqid());

            if(!isset($data['storehouse_id']) && request()->user()->getStorehouseId()){
                $data['storehouse_id'] = request()->user()->getStorehouseId();
            }

            $data['user_id'] = request()->user()->getId();

            $order = $this->order->create($data->toArray());

            DB::commit();
        }catch (Exception $exception){
            DB::rollBack();

            throw new Exception($exception->getMessage());
        }

        return $order;
    }

    /**
     * @throws Exception
     */
    public function update(Order $order, array $data): Order
    {
        $data = collect($data);
        try{
            DB::beginTransaction();

            $order->update($data->toArray());

            DB::commit();
        }catch (Exception $exception){
            DB::rollBack();

            throw new Exception($exception->getMessage());
        }

        return $order;
    }
}
