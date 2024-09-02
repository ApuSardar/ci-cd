<?php

// app/Http/Middleware/ApplyDiscountToProduct.php

namespace App\Http\Middleware;

use Closure;

class ApplyDiscountToProduct
{
    protected $discount;

    public function __construct($discount)
    {
        $this->discount = $discount;
    }

    public function handle($products, Closure $next)
    {
        // Apply discount to each product
        foreach ($products as $product) {
            $product->price -= $product->price * ($this->discount / 100);
            $product->save();
        }

        return $next($products);
    }
}

