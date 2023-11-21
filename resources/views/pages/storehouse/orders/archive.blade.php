@extends('layouts.app')

@section('full-content')
    <div class="row">
        <div class="col-md-12 panel panel-primary">
            <form action="{{ route('storehouse.orders.archive') }}" class="row panel-body" method="get">
                <div class="col-md-2">
                    <label>{{ __('attributes.name') }}</label>
                    <input type="text" name="name" class="form-control" value="{{ request()->input('name') }}">
                </div>

                <div class="col-md-2 col-xs-6">
                    <label >&nbsp;</label>
                    <button type="submit" class="form-control btn btn-sm btn-group-sm btn-primary">
                        <i class="glyphicon glyphicon-filter"></i>
                        {{ __('base.filter') }}
                    </button>
                </div>

                <div class="mt-5 col-md-2 col-xs-6">
                    <a href="{{ route('storehouse.orders.archive') }}" class="btn btn-default form-control">
                        <i class="glyphicon glyphicon-remove"></i>
                        {{ __('base.reset') }}
                    </a>
                </div>
            </form>
        </div>

        <div class="col-md-12">
            <div class="row panel panel-default">
                <div class="col-md-12 mt-4">
                    {{ $orders->appends(request()->all())->links() }}
                </div>

                {{--Table--}}
                <div class="table-responsive col-md-12">
                    <table class="table table-hover">
                        <tr>
                            <th style="width: 130px;">
                                {{ __('attributes.id') }}
                            </th>
                            <th>{{ __('attributes.name') }}</th>
                            <th>{{ __('attributes.quantity') }}</th>
                            <th>{{ __('attributes.weight') }}</th>
                            <th>{{ __('attributes.total') }}</th>
                            <th>{{ __('attributes.fio') }}</th>
                            <th>{{ __('attributes.city') }}</th>
                            <th>{{ __('attributes.phone_number') }}</th>
                            <th>{{ __('attributes.manager') }}</th>
                            <th>&nbsp;</th>
                        </tr>

                        @foreach($orders as $order)
                            <tr>
                                <td>
                                    {{ $order->getId() }}
                                </td>
                                <td>
                                    {{ $order->getName() }}
                                </td>
                                <td>{{ $order->getInitialQuantity() }}</td>
                                <td>{{ $order->getWeight() }} {{ $order->getUnit() }}</td>
                                <td>{{ $order->getTotalAmount() }}</td>
                                <td>
                                    {{ $order->getClientName() }}
                                </td>
                                <td>
                                    {{ $order->getClientCity() }}
                                </td>
                                <td>
                                    {{ $order->getClientNumber() }}
                                </td>

                                <td>
                                    {{ $order->relationUser->getName() }}
                                </td>

                            </tr>
                        @endforeach
                    </table>
                </div>

                <div class="col-md-12 mt-4">
                    {{ $orders->appends(request()->all())->links() }}
                </div>
            </div>
        </div>

        <div class="col-md-12 row">
            <div class="col-md-2 mt-3">
                <a href="{{ route('storehouse.orders.index') }}" class="btn btn-warning form-control">
                    {{ __('nav.back') }}
                </a>
            </div>
        </div>
    </div>
@endsection
