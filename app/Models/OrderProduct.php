<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    /**
     * @var string
     */
    protected $table = 'orders_products';

    /**
     * @var array
     */
    protected $fillable = [
        "order_id", "product_id", "product_modificator_id", "quantity", "sum", "price"
    ];
}
