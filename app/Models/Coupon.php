<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;


    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = [
        'code', 'value'
    ];


    /**
     * Find a Coupon by its code.
     *
     * @param string $code
     * @return mixed
     */
    public static function findByCode(string $code)
    {
        return self::where(compact('code'))->first();
    }
}
