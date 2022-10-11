<?php

namespace App\Services;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductUnitService;
use App\Services\ProductImageService;
use App\Models\Product; 
class ProductService
{

   
    function __construct(private ProductUnitService $productUnitService, private ProductImageService $productImageService){}

    public function get()
    { 
        $options = json_decode(request()->options);
        $itemPerPage = $options->itemsPerPage ?? 5;
        $page = $options->page ?? 1;
        $sortBy = $options->sortBy ?? 'created_at';
        $sortDesc = ($options ? $options->sortDesc : false) ? 'DESC' : 'ASC'; 
       
        return response()->json([
            'success' => true,
            'totol_post' =>  Product::count(),
            'posts' => ProductResource::collection(
                Product::when(
                    request()->options,
                    function ($query) use ($itemPerPage, $page) {
                        $query->offset($itemPerPage * ($page - 1))
                            ->take($itemPerPage);
                    }
                )->orderBy($sortBy, $sortDesc)->get()
            )
        ]);
    }

    public function store(ProductRequest $request)
    {
        
        $product = Product::create($request->json()->all()); 
        $this->productUnitService->store($product,$request);
        $this->productImageService->store($product,$request);       
        return response()->json([
            'success' => true,
            'message' => 'Product store Successfully!',
            'product' => new ProductResource($product),
        ], 301);
      

    }
}
