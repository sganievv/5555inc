<div>
    <div class="row">
        <div class="col-md-12 row">
            <div class="col-md-12">
                {{ __('nav.orders') }}
            </div>
            <div class="col-md-10 col-sm-10 col-xs-8">
                <select class="form-control" wire:model.live="trackingNumber">
                    <option value="tracking-number"></option>
                    @foreach ($orders as $order)
                        @if (!in_array($order->getTrackingNumber(), $selectedTrackingNumbers))

                            <option value="{{ $order->getTrackingNumber() }}">
                                {{ sprintf(' %s |%s |сумма: %s| Кол-во: %s| Объем: %s%s|',
                                    $order->getName(),
                                    $order->getClientCity(),
                                      ($order->getInitialQuantity() != $order->getQuantity()) ? '(Остаток)' : $order->getTotalAmount(),
                                    $order->getQuantity(),
                                    $order->getWeight(),
                                    $order->getUnit()
                                ) }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-4">
                <button type="button" class="btn btn-primary" wire:click="addOrder()">
                    {{ __('base.select') }}
                </button>
            </div>
        </div>

        <div class="col-md-12 mt-3">
            <div class="table-responsive">
                <table class="table">

                    <td colspan="7">
                        <b>{{ __('attributes.total') }}: {{ $totalAmount   }}</b>
                    </td>
                    <tr>
                        <th>{{ __('attributes.name') }}</th>
                        <th>{{ __('attributes.city') }}</th>
                        <th>{{ __('attributes.quantity') }}</th>
                        <th>{{ __('attributes.weight') }}</th>
                        <th>{{ __('attributes.total') }}</th>
                        <th>{{ __('attributes.fio') }}</th>
                        <th>&nbsp;</th>
                    </tr>
                    @foreach($items as $id => $order)
                        <tr>
                            <td>
                                {{ $order['order']->getName() }}
                            </td>
                            <td>
                                {{ $order['order']->getClientCity() }}
                            </td>
                            <td>
                                <input type="hidden" name="orders[{{$id}}][order_id]" value="{{ $order['order']->getId() }}">
                                <input type="hidden" name="orders[{{$id}}][tracking_number]" value="{{ $order['order']->getTrackingNumber() }}">
                                <input type="text" style="width: 50px;" name="orders[{{$id}}][quantity]" value="{{ $order['order']->getQuantity() }}">
                            </td>
                            <td>
                                {{ $order['order']->getWeight() }}  {{ $order['order']->getUnit() }}
                            </td>
                            <td>
                                @if ($order['isRemaining'])
                                    ({{ __('Остаток') }})
                                @else

                                    {{ $order['order']->getTotalAmount() }}
                                    {{-- Прибавляем сумму только если товар не остаток --}}
                                    @php $totalAmount += $order['order']->getTotalAmount(); @endphp
                                @endif
                            </td>
                            <td>
                                {{ $order['order']->getClientName() }}
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm" wire:click="deleteOrder({{ $order['order']->getId() }})">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach


                    <tr>

                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
