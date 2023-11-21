<?php

namespace Domain\Storehouse\Entities;


use App\Core\Entities;
use Domain\Storehouse\Builders\LoadBuilder;
use Domain\User\Entities\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Load.php
 * @property int $id
 * @property string $car
 * @property int $storehouse_from_id
 * @property int $storehouse_to_id
 * @property string $created_at
 *
 * Mixins:
 * @mixin LoadBuilder
 *
 * Relations:
 * @property-read Storehouse $relationStorehouseFrom
 * @property-read Storehouse $relationStorehouseTo
 * @property-read LoadOrder $relationOrders
 *
 * @package Domain\Storehouse\Entities  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 30/10/2023
 */
class Load extends Entities
{
    use SoftDeletes;
    
    protected $table = 'loads';

    protected $guarded = [];

    public function newEloquentBuilder($query): LoadBuilder
    {
        return new LoadBuilder($query);
    }

    public function relationStorehouseFrom(): BelongsTo
    {
        return $this->belongsTo(Storehouse::class, 'storehouse_from_id', 'id');
    }

    public function relationStorehouseTo(): BelongsTo
    {
        return $this->belongsTo(Storehouse::class, 'storehouse_to_id', 'id');
    }

    public function relationOrders(): HasMany
    {
        return $this->hasMany(LoadOrder::class, 'load_id', 'id');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCar(): string
    {
        return $this->car;
    }

    public function getStorehouseFromId(): int
    {
        return $this->storehouse_from_id;
    }

    public function getStorehouseToId(): int
    {
        return $this->storehouse_to_id;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

}
