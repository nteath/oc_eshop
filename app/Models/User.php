<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;


class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'name',
        'email',
        'username',
        'password',
        'address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * A logged in user has many orders.
     *
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }


    /**
     * A User can have a Cart.
     *
     * @return HasOne
     */
    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }


    /**
     * Create a new User and log in.
     *
     * @param string $username
     * @param string $password
     * @return $this
     */
    public function register(string $username, string $password)
    {
        $this->update([
            'username' => $username,
            'password' => bcrypt($password),
        ]);
        $this->generateToken();

        return $this;
    }


    /**
     * Create a new api token for the user.
     *
     * @return string
     */
    public function generateToken(): string
    {
        $this->api_token = Str::random(60);
        $this->save();

        return $this->api_token;
    }
}
