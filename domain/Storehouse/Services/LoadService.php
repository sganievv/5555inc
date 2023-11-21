<?php

namespace Domain\Storehouse\Services;


use App\Core\Services;
use Domain\Storehouse\Entities\Load;
use Illuminate\Support\Facades\DB;
use Exception;

/**
 * Class LoadService.php
 *
 * @package Domain\Storehouse\Services  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 30/10/2023
 */
class LoadService extends Services
{
    public function __construct(Load $load, LoadOrderService $loadOrderService)
    {
        $this->load = $load;
        $this->loadOrderService = $loadOrderService;
    }

    private Load $load;
    private LoadOrderService $loadOrderService;

    /**
     * @throws Exception
     */
    public function create(array $data): Load
    {
        try{
            DB::beginTransaction();

            $data = collect($data);

            $orders = $data->pull('orders') ?? [];
            $load = $this->load->create($data->toArray());

            if(!empty($orders)){
                $this->loadOrderService->insert($load->getId(), $orders);
            }

            DB::commit();
        }catch (Exception $exception){
            DB::rollBack();

            throw new Exception($exception->getMessage());
        }

        return $load;
    }

    /**
     * @throws Exception
     */
    public function update(Load $load, array $data): Load
    {
        try{
            DB::beginTransaction();

            $data = collect($data);

            $orders = $data->pull('orders') ?? [];
            $this->loadOrderService->updateAndInsert($load->getId(), $orders);

            $load->update($data->toArray());

            DB::commit();
        }catch (Exception $exception){
            DB::rollBack();

            throw new Exception($exception->getMessage());
        }

        return $load;
    }
}
