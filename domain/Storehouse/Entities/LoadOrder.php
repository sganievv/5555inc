<?php

namespace Domain\Storehouse\Entities;


use App\Core\Entities;
use Domain\Storehouse\Builders\LoadOrderBuilder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class LoadOrder.php
 * @property int $id
 * @property int $load_id
 * @property int $order_id
 * @property float $quantity
 * @property string tracking_number
 * @property bool $is_accepted
 *
 * Mixins:
 * @mixin LoadOrderBuilder
 *
 * Relations:
 * @property-read Order $relationOrder
 * @property-read Load $relationLoad
 *
 * @package Domain\Storehouse\Entities  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 04/11/2023
 */
class LoadOrder extends Entities
{
    protected $table = 'load_orders';

    protected $guarded = [];

    public function newEloquentBuilder($query): LoadOrderBuilder
    {
        return new LoadOrderBuilder($query);
    }

    public function relationOrder(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function relationLoad(): BelongsTo
    {
        return $this->belongsTo(Load::class, 'load_id', 'id');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLoadId(): int
    {
        return $this->load_id;
    }

    public function getOrderId(): int
    {
        return $this->order_id;
    }

    public function getQuantity(): float
    {
        return $this->quantity;
    }

    public function getTrackingNumber(): string
    {
        return $this->tracking_number;
    }

    public function getIsAccepted(): bool
    {
        return $this->is_accepted ?? false;
    }


}
