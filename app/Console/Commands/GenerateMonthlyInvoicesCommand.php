<?php

namespace App\Console\Commands;

use App\Jobs\GenerateMonthlyInvoiceJob;
use App\Models\User;
use Illuminate\Console\Command;

class GenerateMonthlyInvoicesCommand extends Command
{
    protected $signature = 'invoices:generate';

    protected $description = 'Generate monthly invoices';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        foreach (User::where('is_admin',0)->get() as $user){
            //you donot want one huge job instead you lunch a lot of small jobs (with parameters)
            GenerateMonthlyInvoiceJob::dispatch();
        }

    }
}
