<table class="table">
    <thead>
    <tr>
        <th></th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Created At</th>
        <th>Updated At</th>
    </tr>
    </thead>
    <tbody>
    @foreach($customers as $row)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $row->first_name }}</td>
            <td>{{ $row->lastn_name }}</td>
            <td>{{ $row->email }}</td>
            <td>{{ $row->created_at }}</td>
            <td>{{ $row->updated_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

