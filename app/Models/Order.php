<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    /**
     * @var string
     */
    protected $table = 'orders';

    /**
     * @var array
     */
    protected $fillable = [
        "first_name", "email", "address", "phone", "comment", "payment_id", "delivery_id", "payment_status_id"
    ];

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function payment_status()
    {
        return $this->belongsTo(PaymentStatus::class);
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }





    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories', 'product_id', 'category_id');
    }
}
