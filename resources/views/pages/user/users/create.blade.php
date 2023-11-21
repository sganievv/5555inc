@extends('layouts.app')

@section('full-content')
    <div class="row ">
        <div class="col-md-12 panel panel-default">

            <form class="row panel-body" action="{{ route('user.users.store') }}" method="POST" >
                @csrf

                <div class="col-md-12 row">
                    <div class="col-md-12">
                        <label>{{ __('attributes.fio') }}</label>
                        <input type="text" name="name" placeholder="Name" class="form-control" required value="{{ old('name') }}">
                    </div>

                    <div class="col-md-12 mt-3">
                        <label>{{ __('attributes.login') }}</label>
                        <input type="text" name="login" class="form-control" required value="{{ old('login') }}">
                    </div>

                    <div class="col-md-12 mt-3">
                        <label>{{ __('attributes.phone_number') }}</label>
                        <input type="text" name="phone_number" class="form-control" required value="{{ old('phone_number') }}">
                    </div>

                    <div class="col-md-12 mt-3">
                        <label>{{ __('attributes.role') }}</label>
                        <select name="role" class="form-control" required>
                            @foreach(config('constants.roles') as $role)
                                <option value="{{ $role }}"
                                    {{ $role == old('role') ? 'selected' : '' }}>
                                    {{ __('attributes.'.$role) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 mt-3">
                        <label>{{ __('attributes.storehouse') }}</label>
                        <livewire:storehouses-select :atrName="'storehouse_id'" />
                    </div>

                    <div class="col-md-12 mt-3">
                        <label>{{ __('attributes.password') }}</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="col-md-12 mt-3">
                        <label>{{ __('attributes.password_confirm') }}</label>
                        <input type="password" name="password_confirm" required class="form-control">
                    </div>

                    <div class="col-md-12 row">
                        <div class="col-md-2 mt-3">
                            <button type="submit" class="btn btn-success form-control">
                                {{ __('base.create') }}
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
