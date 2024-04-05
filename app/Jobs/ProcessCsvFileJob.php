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
use Spatie\SimpleExcel\SimpleExcelReader;

class ProcessCsvFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public function __construct(public $file)
    {
        //
    }
    public function handle()
    {

        SimpleExcelReader::create(Storage::disk('local')->path($this->file), "csv")
            ->useDelimiter(',')
            ->useHeaders(['sku','name','description','brand'])
            ->getRows()
            ->chunk(1000)
            ->each(function ( $rowProperties) {

                foreach ($rowProperties as $row) {
                    $product = Product::updateOrCreate(['sku' => $row['sku']], [
                        'name' => $row['name'],
                        'description' => $row['description'],
                        'brand' => $row['brand'],
                    ]);
                }
            });
    }

}
