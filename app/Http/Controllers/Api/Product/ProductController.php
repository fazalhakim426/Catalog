<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    function __construct(private ProductService $productService){
      $this->middleware('auth:api');
    }
    
    public function index()
    {
        return $this->productService->get();
    }
    
    public function store(ProductRequest $request)
    { 
      return $this->productService->store($request);
    }

}
