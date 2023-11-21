<?php

namespace Domain\Storehouse\Services;


use App\Core\Services;
use Domain\Storehouse\Entities\Storehouse;
use Illuminate\Support\Facades\DB;
use Exception;

/**
 * Class StorehouseService.php
 *
 * @package Domain\Storehouse\Services  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 29/10/2023
 */
class StorehouseService extends Services
{
    public function __construct(Storehouse $storehouse)
    {
        $this->storehouse = $storehouse;
    }

    private Storehouse $storehouse;

    /**
     * @throws Exception
     */
    public function create(array $data): Storehouse
    {
         try{
             DB::beginTransaction();

             $storehouse = $this->storehouse->create($data);

             DB::commit();

             return $storehouse;
         }catch (Exception $exception){
             DB::rollBack();

             throw new Exception($exception->getMessage());
         }
    }

    /**
     * @throws Exception
     */
    public function update(Storehouse $storehouse, array $data): Storehouse
    {
        try{
            DB::beginTransaction();

            $storehouse->update($data);

            DB::commit();
        }catch (Exception $exception){
            DB::rollBack();

            throw new Exception($exception->getMessage());
        }

        return $storehouse;
    }
}
