<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use App\Jobs\ProcessCsvFileJob;

class ProcessCsvFile extends Command
{

    protected $signature = 'csv:upload {file}';
    protected $description = 'Upload and process a CSV file';

    public function handle()
    {
        $file = $this->argument('file');
        if (!Storage::disk('local')->exists($file)) {
            $this->error('File does not exist.');
            return 1;
        }
        ProcessCsvFileJob::dispatch($file);
        $this->info('CSV file processed successfully.');
        return 0;
    }
}
