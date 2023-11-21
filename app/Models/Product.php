<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = [
        'uuid',
        'name',
        'description',
        'photo',
        'price',
        'stock_quantity'
    ];


    /**
     * Find a Product by its UUID.
     *
     * @param string $uuid
     * @return mixed
     */
    public static function findByUuid(string $uuid)
    {
        return self::where(compact('uuid'))->first();
    }
}
