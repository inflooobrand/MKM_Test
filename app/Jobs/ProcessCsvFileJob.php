<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use League\Csv\Reader;
use Illuminate\Support\Facades\Storage;

class ProcessCsvFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public function __construct(public $file)
    {
        //
    }
    public function handle()
    {

        $file = $this->file;
        DB::transaction(function () use($file) {
            $contents = Storage::disk('local')->get($file);
            if ($contents !== false) {
                $chunkSize = 1000;                
                $chunks = array_chunk($contents, $chunkSize);
                foreach (array_chunk($chunks, $chunkSize) as $chunk) {
                    $this->processChunk($chunk);
                    if ($this->attempts() % $chunkSize === 0) {
                        $this->release();
                    }
                }
            }   
        });
    }

    protected function processChunk(array $chunk)
    {
        $csv = Reader::createFromString($chunk);
        $csv->setHeaderOffset(0);
        foreach ($csv as $row) {
            $product = Product::updateOrCreate(['sku' => $row['sku']], [
                'name' => $row['name'],
                'description' => $row['description'],
                'brand' => $row['brand'],
            ]);

            // info($row);
        }
    }
}
