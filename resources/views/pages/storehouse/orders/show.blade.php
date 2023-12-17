@extends('layouts.app')

@section('full-content')
    <div class="row panel panel-default">
        <div class="col-md-12">
            <h4>
                {{ __('attributes.tracking_number') }}:
                {{ $order->getId() }}
            </h4>
        </div>

        <div class="col-md-12">
            <label>{{ __('attributes.storehouse') }}:</label>
            @if(!is_null($order->getStorehouseId(2)))
                {{ $order->relationStorehouse->getName() }}
            @else
                -
            @endif
        </div>
        <div class="col-md-12">
            <label>{{ __('attributes.manager') }}:</label>
            {{ optional($order->relationUser)->getName() }}
        </div>

        <div class="col-md-12">
            <label>{{ __('attributes.name') }}:</label>
            {{ $order->getName() }}
        </div>

        <div class="col-md-12">
            <label>{{ __('attributes.comments') }}:</label>
            {{ $order->getComments() }}
        </div>

        <div class="col-md-12">
            <label>{{ __('attributes.quantity') }}:</label>
            {{ $order->getQuantity() }}
        </div>
        <div class="col-md-12">
            <label>{{ __('attributes.weight') }}:</label>
            {{ $order->getWeight() }} {{ $order->getUnit() }}
        </div>
        <div class="col-md-12">
            <label>{{ __('attributes.price') }}:</label>
            {{ $order->getPrice() }}
        </div>
        <div class="col-md-12">
            <label>{{ __('attributes.total') }}:</label>
            {{ $order->getTotalAmount() }}
        </div>
        <div class="col-md-12">
            <label>{{ __('attributes.client') }}:</label>
            {{ $order->getClientName() }}
        </div>
        <div class="col-md-12">
            <label>{{ __('attributes.city') }}:</label>
            {{ $order->getClientCity() }}
        </div>
        <div class="col-md-12">
            <label>{{ __('attributes.phone_number') }}:</label>
            {{ $order->getClientNumber() }}
        </div>

        <div class="col-md-12 mt-3 mb-3">
            <form action="{{ route('storehouse.orders.change_state', $order->getId()) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="is_taken" value="{{ !$order->getIsTaken() }}">

                <div class="col-md-12 row">
                    @if(!$order->getIsTaken())
                    <div class="col-md-2 mt-3">
                        <button type="submit" class="btn btn-success form-control">
                            Передача клиенту
                        </button>
                    </div>
                    @else
                        <div class="col-md-12 mt-3">
                            Посылка передана клиенту
                        </div>
                    @endif


                        <div class="col-md-2 mt-3">
                        <a href="{{ route('storehouse.orders.index') }}" class="btn btn-warning form-control">
                            {{ __('nav.back') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
