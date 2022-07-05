<?php

namespace App\Exports;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomersExportHeading implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $customers = Customer::all();

        //to introduce a space after 3 rows
        $final_collection = [];
        foreach ($customers->chunk(3) as $chunk){
            //every 3 rows we will get array plus empty array
            $final_collection = array_merge($final_collection, $chunk->toArray(),[[]]);
        }

        return collect($final_collection);//transforming it back to collection

    }

    //to begin excel with empty column
//    public function collection()
//    {
//        return Customer::select(DB::raw("'',id,first_name,last_name,email,created_at,updated_at"))->get();
//    }

    public function headings(): array
    {

        //you have to do this manually
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
}
