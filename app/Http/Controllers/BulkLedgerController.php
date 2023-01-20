<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Bus;
use App\Jobs\BulkDataProcess;

class BulkLedgerController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function upload(){
        
        if (request()->has('bulk_ledger')) {
            $data   =   file(request()->bulk_ledger);
            $data = array_slice($data, 6);
            // Chunking file
            $chunks = array_chunk($data, 1000);
            $header = [
                'date',
                'academic_year',
                'session',
                'alloted_category',
                'voucher_type',
                'voucher_no',
                'roll_no',
                'admno_or_unique_id',
                'status',
                'fee_category',
                'faculty',
                'program',
                'department',
                'batch',
                'receipt_no',
                'fee_head',
                'due_amount',
                'paid_amount',
                'concession_amount',
                'scholarship_amount',
                'reverse_concession_amount',
                'write_off_amount',
                'adjusted_amount',
                'refund_amount',
                'fund_transfer_amount',
                'remarks'
            ];
            $batch  = Bus::batch([])->dispatch();
            foreach ($chunks as $key => $chunk) {
                $data = array_map('str_getcsv', $chunk);
                $batch->add(new BulkDataProcess($data, $header));
            }

            return $batch;
        }

        return 'please upload file';
    }
}
