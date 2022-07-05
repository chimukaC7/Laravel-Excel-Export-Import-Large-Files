<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

class CustomersExportDateformat implements FromCollection,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Customer::all();
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->first_name,
            $row->last_name,
            $row->email,
            $row->created_at->format('d/m/Y H:i:s'),
            $row->updated_at->format('d/m/Y H:i:s'),
        ];
    }
}
