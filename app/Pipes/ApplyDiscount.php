<?php


// app/Pipes/ApplyDiscount.php

namespace App\Pipes;

use Closure;

class ApplyDiscount
{
    protected $discount;

    public function __construct($discount)
    {
        $this->discount = $discount;
    }

    public function handle($products, Closure $next)
    {
        $products->each(function ($product) {
            $product->update([
                'discount' => $this->discount,
            ]);
        });

        return $next($products);
    }
}

