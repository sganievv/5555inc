<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\DashboardController;
use App\Http\Validates\User\Users\CreateRequest;
use App\Http\Validates\User\Users\DeleteRequest;
use App\Http\Validates\User\Users\EditRequest;
use App\Http\Validates\User\Users\IndexRequest;
use App\Http\Validates\User\Users\StoreRequest;
use App\Http\Validates\User\Users\UpdateRequest;
use Domain\User\Entities\User;
use Domain\User\Services\UserServices;

/**
 * Class UsersController.php
 *
 * @package App\Http\Controllers\Dashboard\User  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 28/10/2023
 */
class UsersController extends DashboardController
{
    public function __construct(User $user, UserServices $userServices)
    {
        parent::__construct();

        $this->user = $user;
        $this->userServices = $userServices;
    }

    private User $user;
    private UserServices $userServices;

    public function index(IndexRequest $request)
    {
        $params = $request->validated();

        $users = $this->user
            ->filterByParams($params)
            ->orderBy('id', 'desc')
            ->paginate(18);

        return view('pages.user.users.index', [
            'users' => $users
        ]);
    }

    public function edit(User $user, EditRequest $request)
    {
        return view('pages.user.users.edit', [
            'user' => $user
        ]);
    }

    public function update(User $user, UpdateRequest $request)
    {
        $data = $request->validated();

        $this->userServices->update($user, $data);

        return redirect()->route('user.users.index', $user->getId());
    }

    public function create(CreateRequest $request)
    {
        return view('pages.user.users.create');
    }

    public function store(StoreRequest $request)
    {
        $user = $this->userServices->create($request->validated());

        return redirect()->route('user.users.index', $user->getId());
    }

    public function destroy(User $user, DeleteRequest $request)
    {
        $user->delete();

        return redirect()->back();
    }
}
