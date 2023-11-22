@extends('layouts.app')

@section('full-content')
    <div class="row">
        <div class="col-md-12 panel panel-primary">
            <form action="{{ route('user.users.index') }}" class="row panel-body" method="get">
                <div class="col-md-2">
                    <label>{{ __('attributes.fio') }}</label>
                    <input type="text" name="name" class="form-control" value="{{ request()->input('name') }}">
                </div>

                <div class="col-md-2">
                    <label>{{ __('attributes.login') }}</label>
                    <input type="text" name="phone_number" class="form-control" value="{{ request()->input('phone_number') }}">
                </div>
                <div class="col-md-2">
                    <label>{{ __('attributes.role') }}</label>
                    <select class="form-control" id="role" name="role">
                        <option value="">-All-</option>
                        @foreach(config('constants.roles') as $role)
                            <option value="{{ $role }}"
                                {{ $role == request()->input('role') ? 'selected' : '' }}>

                                <label>{{ __('attributes.'.$role) }}</label>
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label >&nbsp;</label>
                    <button type="submit" class="form-control btn btn-sm btn-group-sm btn-primary">
                        <i class="glyphicon glyphicon-filter"></i>
                        {{ __('base.filter') }}
                    </button>
                </div>

                <div class="mt-5 col-md-2">
                    <a href="{{ route('user.users.index') }}" class="form-control btn btn-default">
                        <i class="glyphicon glyphicon-remove"></i>
                        {{ __('base.reset') }}
                    </a>
                </div>
            </form>
        </div>
        <h2>Пользователи</h2>
        <div class="col-md-12">
            <div class="row panel panel-default">
                <div class="col-md-12 mt-4">
                    {{ $users->appends(request()->all())->links() }}
                </div>

                <div class="table-responsive col-md-12">
                    <table class="table table-hover">
                        <tr>
                            <th>{{ __('attributes.id') }}</th>
                            <th>{{ __('attributes.fio') }}</th>
                            <th>{{ __('attributes.login') }}</th>
                            <th>{{ __('attributes.phone_number') }}</th>
                            <th>{{ __('attributes.role') }}</th>
                            <th>{{ __('attributes.storehouse') }}</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>

                        @foreach($users as $user)
                            <tr>
                                <td>
                                    {{ $user->getId() }}
                                </td>
                                <td>
                                    {{ $user->getName() }}
                                </td>
                                <td>{{ $user->getLogin() }}</td>
                                <td>{{ $user->getPhoneNumber() }}</td>
                                <td>
                                    {{ __('attributes.'.$user->getRole()) }}
                                </td>
                                <td>
                                    @if($user->getStorehouseId())
                                        {{ $user->relationStorehouse->getName() }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('user.users.edit', $user->getId()) }}">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                        {{ __('base.edit') }}
                                    </a>
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('user.users.destroy', $user->getId()) }}">
                                        @method('DELETE')
                                        @csrf

                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">
                                            <i class="glyphicon glyphicon-trash"></i>
                                            {{ __('base.delete') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

                <div class="col-md-12 mt-4">
                    {{ $users->appends(request()->all())->links() }}
                </div>
            </div>
        </div>

        <div class="col-md-12 row">
            <div class="col-md-2 mt-3">
                <a href="{{ route('user.users.create') }}" class="btn btn-success form-control">
                    {{ __('base.create') }}
                </a>
            </div>
            <div class="col-md-2 mt-3">
                <a href="{{ route('home') }}" class="btn btn-warning form-control">
                    {{ __('nav.back') }}
                </a>
            </div>
        </div>
    </div>
@endsection
