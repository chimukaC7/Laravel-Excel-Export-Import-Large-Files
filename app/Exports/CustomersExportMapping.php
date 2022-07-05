<?php

namespace App\Exports;

use App\Models\Customer;
use App\Models\Purchase;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

class CustomersExportMapping implements FromCollection,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //with earger loading
        return Purchase::with('customer')->get();
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->customer->first_name. ' '. $row->customer->lastname,
            $row->bank_acc_number,
            $row->company,
            $row->created_at->toDateString(),
            $row->updated_at->toDateString()
        ];
    }
}
