<?php

namespace App\Http\Controllers;

use App\Exports\CustomersExport;
use App\Exports\CustomersExportHeading;
use App\Exports\CustomersExportSheets;
use App\Exports\CustomersExportView;
use App\Models\Customer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CustomersController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    public function export()
    {
        return Excel::download(new CustomersExport(), 'customers.xlsx');
    }

    public function export_view()
    {
        return Excel::download(new CustomersExportView(), 'customers.xlsx');
    }

    public function export_store()
    {
//        Excel::store(new CustomersExport(), 'customers-' . now()->toDateString() . '.xlsx');
        Excel::store(new CustomersExport(), 'customers-' . now()->toDateString() . '.xlsx', 'public');
        return back();
    }

    public function export_format($format)
    {
        $extension = strtolower($format);
        if(in_array($format,['Mpdf','Dompdf','Tcpdf'])) $extension = 'pdf';
        return Excel::download(new CustomersExport(), 'customers.'.$extension, $format);
    }

    public function export_sheets()
    {
        return Excel::download(new CustomersExportSheets(), 'customers.xlsx');
    }

    public function export_heading()
    {
        return Excel::download(new CustomersExportHeading(), 'customers.xlsx');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Customer $customer)
    {
        //
    }

    public function edit(Customer $customer)
    {
        //
    }

    public function update(Request $request, Customer $customer)
    {
        //
    }

    public function destroy(Customer $customer)
    {
        //
    }
}