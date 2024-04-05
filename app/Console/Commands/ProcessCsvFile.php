<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use App\Jobs\ProcessCsvFileJob;

class ProcessCsvFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'csv:upload {file}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload and process a CSV file';
    /**
     * Execute the console command.
     */
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
