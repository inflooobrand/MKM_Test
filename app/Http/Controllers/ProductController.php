<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Repositories\ProductRepositories;
use App\Http\Resources\ProductResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Exception;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private ProductRepositories $productRepo;

    public function __construct(ProductRepositories $productRepo){
        $this->productRepo = $productRepo;
    }

    public function index()
    {
        try {
            $products = $this->productRepo->all();
            return apiResponse(JsonResponse::HTTP_OK, true,'data',ProductResource::collection($products));
        } catch (Exception $exception) {
            return apiResponse(JsonResponse::HTTP_INTERNAL_SERVER_ERROR, false,'message', $exception->getMessage());
        }
    }

    public function show(string $id)
    {
        try {            
            $product=$this->productRepo->show($id);
            if (!$product) {
                return apiResponse(JsonResponse::HTTP_OK, false,'error','Product not found');
            }
            return apiResponse(JsonResponse::HTTP_OK, true,'data',ProductResource::make($product));
        } catch (Exception $exception) {
            return apiResponse(JsonResponse::HTTP_INTERNAL_SERVER_ERROR, false,'message', $exception->getMessage());
        }
    }

    public function processCSVFile(Request $request)
    {
        try {            
            $file = $request->file('file');
            if (!$file) {
                return apiResponse(JsonResponse::HTTP_OK, false,'error','File not found');
            }
            $result=$this->productRepo->process($file);
            return apiResponse(JsonResponse::HTTP_OK, true,'data',$result);
        } catch (Exception $exception) {
            return apiResponse(JsonResponse::HTTP_INTERNAL_SERVER_ERROR, false,'message', $exception->getMessage());
        }
    }

}
