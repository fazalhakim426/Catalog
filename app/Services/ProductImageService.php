<?php
namespace App\Services;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductImage;

class ProductImageService{

    public function store(Product $product,ProductRequest $request)
    {   
        if ($request->json()->get('images')){
            foreach($request->json()->get('images') as $image){  
                ProductImage::create([
                    'productId' => $product->id, 
                    'path' => $image['path']
                ]);

            }
        }
    }
}
