<?php

namespace App\Services;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductUnit;

class ProductUnitService
{

    public function store(Product $product, ProductRequest $request)
    {

        if (
            $request->json()->get('unit') &&
            $request->json()->get('weightPerUnit')
        ) {

            $unit = match (true) {
                $request->json()->get('unit') == 'pcs'  || $request->json()->get('unit') == 'uov' => true,
                default => false,
            };

            if (!$unit) {
                return response()->json([
                    "success" => false,
                    "message" => "Unit must be pcs or uov", //piece counting mode or unit of valume.
                    "errors" => [
                        "unit" => ["Given unit is invalid!"]
                    ]
                ], 422);
            } else {
                ProductUnit::create([
                    'productId' => $product->id,
                    'weightPerUnit' =>  $request->json()->get('weightPerUnit'),
                    'unit' =>  $request->json()->get('unit'),
                ]);
            }
        }
    }
}
