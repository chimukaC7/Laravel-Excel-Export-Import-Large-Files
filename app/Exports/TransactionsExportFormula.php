<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;

class TransactionsExportFormula implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $transactions =  Transaction::all();

        //must match the structor of the model
        $transactions->push(collect([
            'id' => '',
            'customer_id' => "Total:",
            'amount' => "=SUM(C1;C{$transactions->count()})",//just like you would in excel
            'created_at' => "",
            'updated_at' => "",
        ]));

        return $transactions;
    }
}
