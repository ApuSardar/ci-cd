<?php


// app/Http/Requests/UpdateProductRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Allow all users
    }

    public function rules()
    {
        $productId = $this->route('product');

        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $productId,
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'multiple_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => 'required|integer|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'minimum_dispatch_quantity' => 'required|integer|min:1',
            'minimum_order_quantity' => 'required|integer|min:1',
            'send_at_least' => 'required|integer|min:1',
            'minimum_shipment_qty' => 'required|integer|min:1',
            'bulk_order_threshold' => 'required|integer|min:1',
            'minimum_pack_quantity' => 'required|integer|min:1',
            'required_stock_for_order' => 'required|integer|min:1',
            'order_min_quantity' => 'required|integer|min:1',
        ];
    }
}
