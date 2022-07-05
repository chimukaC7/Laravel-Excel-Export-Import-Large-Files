<?php

namespace App\Exports;

use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class CustomersExportView implements FromView
{

    public function view(): View
    {
        return view('customers.table', [
            'customers' => Customer::all()
        ]);
    }
}
