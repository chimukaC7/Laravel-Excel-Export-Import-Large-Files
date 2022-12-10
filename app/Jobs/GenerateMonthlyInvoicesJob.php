<?php

namespace App\Jobs;

use App\Models\User;
use Faker\Factory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateMonthlyInvoicesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    public function __construct()
    {
    }

    public function handle()
    {
        $faker = Factory::create();

        $seller = new Party([
            'name' => 'Private Primary School',
        ]);

        $invoiceNumber = 1;

        foreach (User::where('is_admin',0)->get() as $user){
            $amountToPay = rand(100,999);
        }
    }
}