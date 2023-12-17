@extends('layouts.app')

@section('full-content')
    <div class="row">
        <h2>
            {{ __('constants.inventory', ['name' => request()->user()?->relationStorehouse?->getName()]) }}
        </h2>

        <div class="col-md-12 panel panel-primary">
            <form action="{{ route('storehouse.orders.index') }}" class="row panel-body" method="get">
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
                    <a href="{{ route('storehouse.orders.index') }}" class="btn btn-default form-control">
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
                    @php
                        $remainingTotal = 0; // инициализируем переменную для остатка
                    @endphp

                    @foreach($orders as $order)
                        @if ($order->getInitialQuantity() == $order->getQuantity())
                            @php
                                $remainingTotal += $order->getTotalAmount(); // прибавляем сумму для товаров без изменения количества
                            @endphp
                        @endif
                    @endforeach

                    <tr>
                        <th>{{ __('attributes.totals') }}:</th>
                        <td colspan="9">
                            {{ $remainingTotal }}
                            сомони
                        </td>
                    </tr>
                    <table class="table table-hover">
                        <tr>
                            <th style="width: 130px;">
                            {{ __('attributes.date') }}
                            </th>
                            <th>{{ __('attributes.name') }}</th>
                            <th>{{ __('attributes.quantity') }}</th>
                            <th>{{ __('attributes.weight') }}</th>
                            <th>{{ __('attributes.total') }}</th>
                            <th>{{ __('attributes.fio') }}</th>
                            <th>{{ __('attributes.city') }}</th>
                            <th>{{ __('attributes.phone_number') }}</th>
                            <th>{{ __('attributes.comments') }}</th>
                            <th>{{ __('attributes.manager') }}</th>

                            <th>&nbsp;</th>
                        </tr>

                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->getCreatedAt() }}</td>
                                <td>
                                    @if(request()->user()->getStorehouseId() == 2)
                                        <a href="{{ route('storehouse.orders.show', $order->getId()) }}">
                                            <i class="glyphicon glyphicon-eye-open"></i>
                                            {{ $order->getName() }}
                                        </a>
                                    @else
                                        {{ $order->getName() }}
                                    @endif
                                </td>
                                <td>{{ $order->getQuantity() }}</td>
                                <td>{{ $order->getWeight() }} {{ $order->getUnit() }}</td>
                                <td>
                                    @if ($order->getInitialQuantity() != $order->getQuantity())
                                        Остаток
                                    @else
                                        {{ $order->getTotalAmount() }}
                                    @endif
                                </td>
                                <td>
                                    {{ $order->getClientName() }}
                                </td>
                                <td>
                                    {{ $order->getClientCity() }}
                                </td>
                                <td>
                                    {{ $order->getClientNumber() }}
                                </td>
                                <td>{{ $order->getComments() }}</td>

                                <td>
                                    {{ optional($order->relationUser)->getName() }}
                                </td>
                                <td>
                                    @if(request()->user()->getStorehouseId() == 1)
                                        <a href="{{ route('storehouse.orders.edit', $order->getId()) }}">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                            {{ __('base.edit') }}
                                        </a>
                                    @endif
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


                <a href="{{ route('storehouse.orders.archive', ['storehouse_id' => request()->get('storehouse_id')]) }}" class="btn btn-primary form-control">
                    {{ __('base.archive') }}
                </a>

            </div>

            <div class="col-md-2 mt-3">
                @if(auth()->user()->storehouse_id)
                    <a href="{{ route('home') }}" class="btn btn-warning form-control">
                        {{ __('nav.back') }}
                    </a>
                @else
                    <a href="{{ route('storehouse.storehouses.index') }}" class="btn btn-warning form-control">
                        {{ __('nav.back') }}
                    </a>
                @endif
            </div>


        </div>
    </div>
@endsection
