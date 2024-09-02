<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'price',
        'main_image',
        'multiple_images',
        'stock',
        'discount',
        'minimum_dispatch_quantity',
        'minimum_order_quantity',
        'send_at_least',
        'minimum_shipment_qty',
        'bulk_order_threshold',
        'minimum_pack_quantity',
        'required_stock_for_order',
        'order_min_quantity',

    ];
}
