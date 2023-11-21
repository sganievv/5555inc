<?php

namespace Domain\Storehouse\Entities;


use App\Core\Entities;
use Domain\Storehouse\Builders\StorehouseBuilder;

/**
 * Class Storehouse.php
 * @property int $id
 * @property string $name
 * @property string $address
 *
 * Mixins:
 * @mixin StorehouseBuilder
 *
 * @package Domain\Storehouse\Entities  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 29/10/2023
 */
class Storehouse extends Entities
{
    protected $table = 'storehouses';

    protected $guarded = [];

    public function newEloquentBuilder($query): StorehouseBuilder
    {
        return new StorehouseBuilder($query);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAddress(): string
    {
        return $this->address;
    }
}
