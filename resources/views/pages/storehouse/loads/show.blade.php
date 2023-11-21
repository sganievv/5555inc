<?php
 $totalAmount = 0;
?>
@extends('layouts.app')

@section('full-content')
    <div class="row panel panel-default">
        <div class="col-md-12 mt-3 row">
            <div class="col-md-6 mb-3 row">
                <div class="col-md-12">
                    <label>{{ __('attributes.car') }}:</label>
                    {{ $load->getCar() }}
                </div>
                <div class="col-md-12">
                    <label>{{ __('attributes.from_storehouse') }}:</label>
                    {{ $load->relationStorehouseFrom->getName() }}
                </div>
                <div class="col-md-12">
                    <label>{{ __('attributes.to_storehouse') }}:</label>
                    {{ $load->relationStorehouseTo->getName() }}
                </div>
            </div>

            <div class="col-md-5 row">
                <div class="table-responsive">
                    <table class="table">

                        <tr>
                            <th>{{ __('attributes.name') }}</th>
                            <th>{{ __('attributes.quantity') }}</th>
{{--                            <th>{{ __('attributes.weight') }}</th>--}}
                            <th>{{ __('attributes.total') }}</th>
                            <th>&nbsp;</th>
                        </tr>
                        @foreach($load->relationOrders as $item)
                            <tr>

                                <td>
                                    {{ $item->relationOrder->getName() }}
                                </td>
                                <td>
                                    {{ $item->getQuantity() }}
                                </td>

{{--                                <td>--}}
{{--                                    {{ $item->relationOrder->getWeight() }},{{ $item->relationOrder->getUnit() }}--}}
{{--                                </td>--}}

                                <td>
                                    {{ $item->relationOrder->getTotalAmount() }}
                                    <?php
                                        $totalAmount += $item->relationOrder->getTotalAmount();
                                    ?>
                                </td>
                                <td>
                                    @if(!$item->getIsAccepted())
                                        <form method="POST" action="{{ route('storehouse.loads.accept_order', $item->getId()) }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="is_accepted" value="1">
                                            <button type="submit" class="btn btn-sm btn-success">
                                                Принять
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>

        </div>


        <label>{{ __('attributes.totals') }}:</label>
            <label colspan="5">
                {{ $totalAmount }}
            </label>

        <div class="col-md-12 mt-3 mb-3 row">
            <div class="col-md-2 mt-3">
                <a href="{{ route('storehouse.loads.index') }}" class="btn btn-warning form-control">
                    {{ __('nav.back') }}
                </a>
            </div>

        </div>
    </div>
@endsection
