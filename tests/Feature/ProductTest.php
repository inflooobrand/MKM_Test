<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class ProductTest extends TestCase
{

    public function testGetSku()
    {
        $product = new Product();
        $sku = 'PRD456';
        $product->sku = $sku;
        $result = $product->getSku();
        $this->assertEquals($sku, $result);
    }
}
