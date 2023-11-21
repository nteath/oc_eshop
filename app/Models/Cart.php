<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Listeners\UpdateCartValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Cart extends Model
{
    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = [
        'uuid',
        'value',
        'user_id',
    ];


    /**
     * Creates an empty Cart.
     *
     * @return mixed
     */
    public static function init()
    {
        $data = ['uuid' => Str::uuid()];

        // If user is logged in, associate cart to user.
        if ($user = auth('api')->user()) {
            $data = array_merge($data, ['user_id' => $user->id]);
        }

        return self::create($data);
    }


    /**
     * Find a Cart by its UUID.
     *
     * @param string $uuid
     * @return mixed
     */
    public static function findByUuid(string $uuid)
    {
        return self::where(compact('uuid'))->first();
    }


    /**
     * Get all items belonging in a Cart.
     *
     * @return BelongsToMany
     */
    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'cart_items')
                    ->withPivot('quantity')
                    ->withTimestamps()
                    ->as('extra');
    }


    /**
     * Check if the Cart contains a specific Product
     * and return the Product.
     *
     * @param Product $product
     * @return null|Product
     */
    public function contains(Product $product): ?Product
    {
        return $this->items->find($product);
    }


    /**
     * A Cart can have an applied Coupon.
     *
     * @return BelongsTo
     */
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }


    /**
     * A Cart can be associated to a logged in user.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Cart's current value after discounts applied.
     *
     * NOTE: Cart's value is updated when a Product
     * is added to the Cart.
     * @see UpdateCartValue::class
     *
     * @return mixed
     */
    public function calculateCurrentValue(): mixed
    {
        if ($coupon = $this->coupon) {
            return $this->value - $coupon->value;
        }

        return $this->value;
    }
}
