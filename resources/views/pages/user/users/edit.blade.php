@extends('layouts.app')

@section('full-content')
    <div class="row ">
        <div class="col-md-12 panel panel-default">

            <form class="row panel-body" action="{{ route('user.users.update', $user->getId()) }}" method="POST" >
                @method('put')
                @csrf

                <div class="col-md-12 row">
                    <div class="col-md-12">
                        <label>{{ __('attributes.fio') }}</label>
                        <input type="text" name="name" placeholder="Name" class="form-control" required value="{{ $user->getName() }}">
                    </div>

                    <div class="col-md-12 mt-3">
                        <label>{{ __('attributes.login') }}</label>
                        <input type="text" name="login" class="form-control" required value="{{ $user->getLogin() }}">
                    </div>

                    <div class="col-md-12 mt-3">
                        <label>{{ __('attributes.phone_number') }}</label>
                        <input type="text" name="phone_number" class="form-control" required value="{{ $user->getPhoneNumber() }}">
                    </div>

                    <div class="col-md-12 mt-3">
                        <label>{{ __('attributes.role') }}</label>
                        <select name="role" class="form-control" required>
                            @foreach(config('constants.roles') as $role)
                                <option value="{{ $role }}"
                                    {{ $role == $user->getRole() ? 'selected' : '' }}>

                                    {{ __('attributes.'.$role) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 mt-3">
                        <label>{{ __('attributes.storehouse') }}</label>
                        <livewire:storehouses-select :atrName="'storehouse_id'" :selectedId="$user->getStorehouseId()"/>
                    </div>

                    <div class="col-md-12 mt-3">
                        <label>{{ __('attributes.password') }}</label>
                        <input type="text" name="password" placeholder="Пароль" id="password" class="form-control">
                    </div>

                    <div class="col-md-12 mt-3">
                        <label>{{ __('attributes.password_confirm') }}</label>
                        <input type="text" name="password_confirm" placeholder="Пароль" id="password_confirm" class="form-control">
                    </div>

                    <div class="col-md-12 row">
                        <div class="col-md-2 mt-3">
                            <button type="submit" class="btn btn-primary form-control">
                                {{ __('base.save') }}
                            </button>
                        </div>
                        <div class="col-md-2 mt-3">
                            <a href="{{ route('user.users.index') }}" class="btn btn-warning form-control">
                                {{ __('nav.back') }}
                            </a>
                        </div>
                    </div>

                </div>

            </form>

        </div>
    </div>
@endsection
