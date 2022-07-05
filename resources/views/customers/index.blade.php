@extends('layouts.app')

@section('content')
    <div class="panel-heading">Customers</div>
    <div class="panel-body">
        <a href="{{route('customers.export')}}" class="btn btn-primary">Export all customers</a>
        <a href="{{route('customers.export-view')}}" class="btn btn-primary">Download all customers</a>
        <a href="{{route('customers.export-store')}}" class="btn btn-primary">Store As File</a>

        <a href="{{route('customers.export-format','Csv')}}" class="btn btn-info">Download CSV</a>
        <a href="{{route('customers.export-format','Html')}}" class="btn btn-info">Download HTML</a>
        <a href="{{route('customers.export-format','Dompdf')}}" class="btn btn-info">Download PDF</a>

        <a href="{{route('customers.export-sheets',)}}" class="btn btn-info">Download Multiple Sheets</a>
        <a href="{{route('customers.export-heading',)}}" class="btn btn-info">Export with Heading Row</a>
        <a href="{{route('customers.export-mapping',)}}" class="btn btn-info">Export Purchases</a>
        <a href="{{route('customers.export-styling',)}}" class="btn btn-info">Export with Styling</a>
        <a href="{{route('customers.export-autosize',)}}" class="btn btn-info">Export with Autosize</a>
        <a href="{{route('customers.export-dateformat',)}}" class="btn btn-info">Export with Date format</a>

        <br/>
        <form action="{{route('customers.import')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="import"/>
            <input type="submit" class="btn btn-sm btn-primary" value="Import File"/>
        </form>

        <form action="{{route('customers.import-large')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="import"/>
            <input type="submit" class="btn btn-sm btn-primary" value="Import File"/>
        </form>

        <form action="{{route('customers.import-relationship')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="import"/>
            <input type="submit" class="btn btn-sm btn-primary" value="Import File"/>
        </form>

        <form action="{{route('customers.import-dateformat')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="import"/>
            <input type="submit" class="btn btn-sm btn-primary" value="Import File"/>
        </form>


        <br/>
        <br/>

        @include('customers.table',$customers)
{{--        <table class="table">--}}
{{--            <thead>--}}
{{--            <tr>--}}
{{--                <th></th>--}}
{{--                <th>Firstname</th>--}}
{{--                <th>Lastname</th>--}}
{{--                <th>Email</th>--}}
{{--                <th>Created At</th>--}}
{{--                <th>Updated At</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            @foreach($customers as $row)--}}
{{--                <tr>--}}
{{--                    <td>{{ $loop->iteration }}</td>  <!-generates the iteration number-->--}}
{{--                    <td>{{ $row->first_name }}</td>--}}
{{--                    <td>{{ $row->lastn_name }}</td>--}}
{{--                    <td>{{ $row->email }}</td>--}}
{{--                    <td>{{ $row->created_at }}</td>--}}
{{--                    <td>{{ $row->updated_at }}</td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--            </tbody>--}}
{{--        </table>--}}

    </div>

@endsection