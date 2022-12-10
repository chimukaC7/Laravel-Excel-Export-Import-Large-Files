<?php

namespace App\Exports;

use App\Models\Customer;
use App\Models\Purchase;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

class CustomersExportMapping implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize,WithStyles
{
    //recommended
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //with earger loading
        return Purchase::with('customer')->get();
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true]],

        ];
    }

    public function headings(): array
    {
        return [
            "ID",
            "CUSTOMER NAME",
            "BANK ACCOUNT",
            "COMPANY",
            "CREATED AT",
            "UPDATED AT",
        ];
    }

    public function map($row): array
    {
        return [
            $row->id ?? "----",
            $row->customer->first_name ?? "----". ' '. $row->customer->lastname ?? "----",
            $row->bank_acc_number ?? "----",
            $row->company ?? "----",
//            $row->created_at->toDateString() ?? "----",
//            $row->updated_at->toDateString() ?? "----"
            !is_null($row->created_at) ? date("d M Y", strtotime($row->created_at)) : " ",
            !is_null($row->updated_at) ? date("d M Y", strtotime($row->updated_at)) : " ",
        ];
    }
}
