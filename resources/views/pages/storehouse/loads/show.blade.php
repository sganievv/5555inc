<?php
$totalAmount = 0;
$acceptedOrderIds = [];
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
                    {{ $load->relationStorehouseFrom ? $load->relationStorehouseFrom->getName() : 'N/A' }}
                </div>
                <div class="col-md-12">
                    <label>{{ __('attributes.to_storehouse') }}:</label>
                    {{ $load->relationStorehouseTo ? $load->relationStorehouseTo->getName() : 'N/A' }}
                </div>

            </div>

            <div class="col-md-5 row">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>{{ __('attributes.name') }}</th>
                            <th>{{ __('attributes.quantity') }}</th>
                            <th>{{ __('attributes.total') }}</th>
                            <th>&nbsp;</th>
                        </tr>
                        @foreach($load->relationOrders as $item)
                            <tr>
                                <td>
                                    {{optional ($item->relationOrder)->getName() }}
                                </td>
                                <td>
                                    {{ $item->getQuantity() }}
                                </td>

                                <td>
                                        <?php
                                        $itemTotalAmount = optional($item->relationOrder)->getTotalAmount();

                                        // Проверка, является ли товар остатком
                                        if (!in_array($item->getId(), $acceptedOrderIds)) {
                                            // Сравнение tracking_number для товаров в складе id 2
                                            if (
                                                auth()->check() &&
                                                auth()->user()->storehouse_id == 2 &&
                                                $load->relationStorehouseTo->id == 2 &&
                                                // Дополнительная проверка tracking_number
                                                $load->relationStorehouseTo->tracking_number == optional($item->relationOrder)->tracking_number
                                            ) {
                                                $totalAmount += 0; // Установить сумму в 0
                                            } else {
                                                $totalAmount += $itemTotalAmount;
                                            }

                                            echo $itemTotalAmount;
                                            $acceptedOrderIds[] = $item->getId(); // Добавляем ID товара в список принятых
                                        } else {
                                            echo 'Остаток';
                                        }
                                        ?>
                                </td>

                                <td>
                                    @if(auth()->check() && auth()->user()->storehouse_id == 2)
                                        @if(!$item->getIsAccepted())
                                            <form method="POST" action="{{ route('storehouse.loads.accept_order', $item->getId()) }}">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="is_accepted" value="1">
                                                <button type="submit" class="btn btn-sm btn-success">
                                                    Принять
                                                </button>
                                            </form>
                                                <?php
                                                $acceptedOrderIds[] = $item->getId();
                                                ?>
                                        @endif
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
