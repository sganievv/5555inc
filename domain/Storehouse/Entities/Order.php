<?php

namespace Domain\Storehouse\Entities;


use App\Core\Entities;
use Domain\Storehouse\Builders\OrderBuilder;
use Domain\User\Entities\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Type\Integer;

/**
 * Class Order.php
 * @property int $id
 * @property string $tracking_number
 * @property int $user_id
 * @property int $storehouse_id
 * @property string $client_name
 * @property string $client_city
 * @property string $client_number
 * @property string $name
 * @property float $quantity
 * @property-read  float $initial_quantity
 * @property float $weight
 * @property string $unit
 * @property float $price
 * @property float $total_amount
 * @property bool $is_taken
 * @property ?string $comments
 * @property ?string $created_at
 *
 * Mixins:
 * @mixin OrderBuilder
 *
 * Relations:
 * @property-read User $relationUser
 * @property-read Storehouse $relationStorehouse
 *
 * @package Domain\Storehouse\Entities  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 29/10/2023
 */
class Order extends Entities
{
    use SoftDeletes;

    protected $table = 'orders';

    protected $guarded = [];

    public function newEloquentBuilder($query): OrderBuilder
    {
        return new OrderBuilder($query);
    }

    public function relationUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function relationStorehouse(): BelongsTo
    {
        return $this->belongsTo(Storehouse::class, 'storehouse_id', 'id');
    }

    public function relationLoads(): HasMany
    {
        return $this->hasMany(LoadOrder::class, 'order_id', 'id');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTrackingNumber(): string
    {
        return $this->tracking_number;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getStorehouseId(): ?int
    {
        return $this->storehouse_id;
    }

    public function getClientName(): string
    {
        return $this->client_name;
    }

    public function getClientCity(): string
    {
        return $this->client_city;
    }

    public function getClientNumber(): string
    {
        return $this->client_number;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getQuantity(): float
    {
        return $this->quantity ?? 0.0;
    }

    public function getInitialQuantity(): float
    {
        return $this->initial_quantity ?? 0.0;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getTotalAmount(): float
    {
        return $this->total_amount;
    }

    public function getIsTaken(): bool
    {
        return $this->is_taken;
    }

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }
}
