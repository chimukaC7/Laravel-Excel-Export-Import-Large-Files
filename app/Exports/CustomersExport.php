<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;

class CustomersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return Customer::all();//exports all customers
        //return Customer::where('email','like','%example.org')->get();
        //return Customer::select('first_name','last_name','email')->get();
        return Customer::select('first_name','last_name','email')
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();
    }
}
