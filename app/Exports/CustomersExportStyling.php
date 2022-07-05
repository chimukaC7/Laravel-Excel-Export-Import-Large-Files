<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class CustomersExportStyling implements FromCollection,WithHeadings,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Customer::all();
    }

    public function headings(): array
    {
        return [
            //' ',
            '#',
            'First Name',
            'Last Name',
            'Email',
            'Created at',
            'Updated at'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event){
                $cellRange = 'A1:W1';//All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);

                $styleArray = [
                    'borders'=>[
                        'outline'=>[
                            'borderStyle' => Border::BORDER_THICK,
                            'color'=>['argb'=>'FFFF0000'],
                        ]
                    ],
                ];
                $event->sheet->getDelegate()->getStyle('B2:G8')->applyFromArray($styleArray);
            }
        ];
    }


}
