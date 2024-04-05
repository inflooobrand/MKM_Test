<?php

namespace App\Repositories;

use App\Repositories\contracts\CurdContracts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use App\Models\Product;
use Illuminate\Http\Response;
use Exception;
use Illuminate\Support\Facades\Artisan;


class ProductRepositories implements CurdContracts
{

    public function all()
    {
        try {                
                return Product::all();
            } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function show($id)
    {
        try {
            return Product::where('sku',$id)->first();
            } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function process($file)
    {
        $filePath = $file->store();
        Artisan::call('csv:upload', ['file' => $filePath]);
        return Artisan::output();
    }


}

