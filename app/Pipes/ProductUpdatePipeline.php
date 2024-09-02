<?php
// app/Pipes/ProductUpdatePipeline.php

// app/Pipes/ProductUpdatePipeline.php

namespace App\Pipes;

use Illuminate\Pipeline\Pipeline;
use App\Http\Middleware\ApplyDiscountToProduct;

class ProductUpdatePipeline extends Pipeline
{
    public function __construct()
    {
        parent::__construct(app());
    }

    public function handle($products, \Closure $next)
    {
        return $this->send($products)
            ->through([
                new ApplyDiscount(10), // Set a 10% discount (or any value you want)
                new ApplyDiscountToProduct(20) // Apply a 20% discount to the price
            ])
            ->thenReturn($next($products));
    }
}
