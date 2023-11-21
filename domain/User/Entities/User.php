<?php

namespace Domain\User\Entities;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Domain\Storehouse\Entities\Storehouse;
use Domain\User\Builders\UserBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $name
 * @property string $login
 * @property string $phone_number
 * @property string $password
 * @property string $role
 * @property ?int $storehouse_id
 *
 * Mixins:
 * @mixin UserBuilder
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    public function newEloquentBuilder($query): UserBuilder
    {
        return new UserBuilder($query);
    }

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    public function relationStorehouse(): HasOne
    {
        return $this->hasOne(Storehouse::class, 'id', 'storehouse_id');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getStorehouseId(): int
    {
        return $this->storehouse_id ?? 0;
    }
}
