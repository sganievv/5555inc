<?php

namespace Domain\Storehouse\Builders;


use App\Core\Builders;

/**
 * Class LoadOrderBuilder.php
 *
 * @package Domain\Storehouse\Builders  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 04/11/2023
 */
class LoadOrderBuilder extends Builders
{
    public function whereLoadId(int $loadId): LoadOrderBuilder
    {
        return $this->where('load_id', '=', $loadId);
    }

    public function whereOrderId(int $orderId): LoadOrderBuilder
    {
        return $this->where('order_id', '=', $orderId);
    }

    public function whereTrackingNumber(string $trackingNumber): LoadOrderBuilder
    {
        return $this->where('tracking_number', '=', $trackingNumber);
    }

}
