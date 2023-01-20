<?php

namespace App\Jobs;

use Throwable;
use App\Models\BulkLedger;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BulkDataProcess implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    public $header;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $header)
    {
        $this->data   = $data;
        $this->header = $header;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->data as $record) {
            $record = array_slice($record, 1,26);
            $bulkData = array_combine($this->header, $record);
            BulkLedger::create($bulkData);
        }
    }

    public function failed(Throwable $exception)
    {
        dd($exception);
        // Send user notification of failure, etc...
    }
}
