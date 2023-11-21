@extends('layouts.app')

@section('full-content')
    <div class="row">
        <h2>Склады</h2>
        <div class="col-md-12 panel panel-primary">
            <form action="{{ route('storehouse.storehouses.index') }}" class="row panel-body" method="get">
                <div class="col-md-2">
                    <label>{{ __('attributes.id') }}</label>
                    <input type="text" name="id" class="form-control" value="{{ request()->input('id') }}">
                </div>

                <div class="col-md-2">
                    <label>{{ __('attributes.name') }}</label>
                    <input type="text" name="name" class="form-control" value="{{ request()->input('name') }}">
                </div>

                <div class="col-md-2">
                    <label>{{ __('attributes.address') }}</label>
                    <input type="text" name="address" class="form-control" value="{{ request()->input('address') }}">
                </div>

                <div class="col-md-2">
                    <label >&nbsp;</label>
                    <button type="submit" class="form-control btn btn-sm btn-group-sm btn-primary">
                        <i class="glyphicon glyphicon-filter"></i>
                        {{ __('base.filter') }}
                    </button>
                </div>

                <div class="mt-5 col-md-2">
                    <a href="{{ route('storehouse.storehouses.index') }}" class="btn btn-default form-control">
                        <i class="glyphicon glyphicon-remove"></i>
                        {{ __('base.reset') }}
                    </a>
                </div>
            </form>
        </div>

        <div class="col-md-12">
            <div class="row panel panel-default">
                <div class="col-md-12 mt-4">
                    {{ $storehouses->appends(request()->all())->links() }}
                </div>

                <div class="table-responsive col-md-12">
                    <table class="table table-hover">
                        <tr>
                            <th>{{ __('attributes.id') }}</th>
                            <th>{{ __('attributes.name') }}</th>
                            <th>{{ __('attributes.address') }}</th>
                            <th>&nbsp;</th>
                        </tr>

                        @foreach($storehouses as $storehouse)
                            <tr>
                                <td>
                                    {{ $storehouse->getId() }}
                                </td>
                                <td>
                                    <a href="{{ route('storehouse.orders.index', ['storehouse_id' => $storehouse->getId()]) }}">
                                        <i class="glyphicon glyphicon-eye-open"></i>
                                        {{ $storehouse->getName() }}
                                    </a>
                                </td>
                                <td>{{ $storehouse->getAddress() }}</td>
                                <td>
                                    <a href="{{ route('storehouse.storehouses.edit', $storehouse->getId()) }}">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                        {{ __('base.edit') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>


                <div class="col-md-12 mt-4">
                    {{ $storehouses->appends(request()->all())->links() }}
                </div>
            </div>
        </div>

        <div class="col-md-12 row">
            <div class="col-md-2 mt-3">
                <a href="{{ route('storehouse.storehouses.create') }}" class="btn btn-success form-control">
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
