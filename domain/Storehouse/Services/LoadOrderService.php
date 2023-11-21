<?php

namespace Domain\Storehouse\Services;


use App\Core\Services;
use Domain\Storehouse\Entities\LoadOrder;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class LoadOrderService.php
 *
 * @package Domain\Storehouse\Services  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 04/11/2023
 */
class LoadOrderService extends Services
{
    public function __construct(LoadOrder $loadOrder)
    {
        $this->loadOrder = $loadOrder;
    }

    private LoadOrder $loadOrder;

    /**
     * @throws Exception
     */
    public function insert(int $loadId, array $data): bool
    {
        try{
            DB::beginTransaction();

            $items = [];
            foreach ($data as $item)
            {
                $items[] = [
                    'load_id' => $loadId,
                    'order_id' => $item['order_id'],
                    'quantity' => $item['quantity'],
                    'tracking_number' => $item['tracking_number'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            $this->loadOrder->insert($items);

            DB::commit();
        }catch (Exception $exception){
            DB::rollBack();
            throw new Exception($exception->getMessage());
        }

        return true;
    }

    /**
     * @throws Exception
     */
    public function updateAndInsert(int $loadId, array $data): bool
    {
        try{
            DB::beginTransaction();

            $this->loadOrder
                ->whereLoadId($loadId)
                ->delete();

            $this->insert($loadId, $data);

            DB::commit();
        }catch (Exception $exception){
            DB::rollBack();
            throw new Exception($exception->getMessage());
        }

        return true;
    }

    public function update(LoadOrder $loadOrder, array $data)
    {
        try{
            DB::beginTransaction();

            $loadOrder->update($data);

            DB::commit();
        }catch (Exception $exception){
            DB::rollBack();
            throw new Exception($exception->getMessage());
        }

        return true;
    }
}
