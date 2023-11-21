<?php

namespace Domain\User\Services;


use App\Core\Services;
use Domain\User\Entities\User;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserServices.php
 *
 * @package Domain\User\Services  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 28/10/2023
 */
class UserServices extends Services
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    private User $user;

    /**
     * @throws Exception
     */
    public function create(array $data): User
    {
        try{
            DB::beginTransaction();

            $data['password'] = Hash::make($data['password']);
            unset($data['password_confirm']);

            if(is_null($data['storehouse_id']))
                $data['storehouse_id'] = 0;

            $user = $this->user->create($data);

            DB::commit();

            return $user;
        }catch (Exception $exception){
            DB::rollBack();

            throw new Exception($exception->getMessage());
        }
    }

    public function update(User $user, array $data): User
    {
        try{
            DB::beginTransaction();

            if(isset($data['password']) && !empty($data['password']))
                $data['password'] = Hash::make($data['password']);

            if(is_null($data['storehouse_id']))
                $data['storehouse_id'] = 0;

            unset($data['password_confirm']);

            $user->update($data);

            DB::commit();

        }catch (Exception $exception){
            DB::rollBack();

            throw new Exception($exception->getMessage());
        }

        return $user;
    }
}
