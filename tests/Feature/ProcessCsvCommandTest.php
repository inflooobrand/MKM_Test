<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;


class ProcessCsvCommandTest extends TestCase
{
    public function testProcessCsvCommand()
        {

            $filePath = storage_path('app/products.csv');
            $this->artisan('csv:upload', ['file' => $filePath]);
        }
}
