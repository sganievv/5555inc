@extends('layouts.app')

@section('full-content')
    <div class="row ">
        <div class="col-md-12 panel panel-default">

            <form class="row panel-body" action="{{ route('storehouse.orders.update', $order->getId()) }}" method="POST" >
                @csrf
                @method('put')

                <div class="col-md-12 row">
                    <div class="col-md-12 panel panel-primary">
                        <div class="row panel-body">
                            <div class="col-md-12">
                                <h4>{{ __('attributes.client') }}</h4>
                            </div>
                            <div class="col-md-12">
                                <label>{{ __('attributes.fio') }}</label>
                                <input name="client_name" class="form-control" required value="{{ $order->getClientName() }}">
                            </div>

                            <div class="col-md-12">
                                <label>{{ __('attributes.city') }}</label>
                                <input name="client_city" class="form-control" required value="{{ $order->getClientCity() }}">
                            </div>

                            <div class="col-md-12">
                                <label>{{ __('attributes.phone_number') }}</label>
                                <input name="client_number" class="form-control" required value="{{ $order->getClientNumber() }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-3">
                        <label>{{ __('attributes.name') }}</label>
                        <input type="text" name="name" class="form-control" required value="{{ $order->getName() }}">
                    </div>

                    <div class="col-md-12">
                        <livewire:price-calculator
                            :quantity="$order->getQuantity()"
                            :weight="$order->getWeight()"
                            :unit="$order->getUnit()"
                            :price="$order->getPrice()"
                            :totalAmount="$order->getTotalAmount()"
                        />
                    </div>

                    <div class="col-md-12 mt-3">
                        <label>{{ __('attributes.comments') }}</label>
                        <textarea class="form-control" name="comments" rows="3">{{ $order->getComments() }}</textarea>
                    </div>
                </div>

                <div class="col-md-12 row">
                    <div class="col-md-2 mt-3">
                        <button type="submit" class="btn btn-primary form-control">
                            {{ __('base.save') }}
                        </button>
                    </div>

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
