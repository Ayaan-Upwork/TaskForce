@extends('layouts.admin')
<title>Holidays</title>
@section('links')
    {{-- <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"> --}}
    {{-- <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" /> --}}
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Holiday Page</h4>
        </div>
        <div class="row col-md-2">
            <a href="{{ url('leaves') }}" class="btn btn-primary">Add Holiday</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="myTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Employee Name</th>
                        <th>Employee Email</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Holiday</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($leaves as $leave)
                        <tr>
                            <td>{{ $leave->user->id }}</td>
                            <td>{{ $leave->user->employe_name }}</td>
                            <td>{{ $leave->user->employe_email }}</td>
                            <td>{{ $leave->start_date }}</td>
                            <td>{{ $leave->end_date }}</td>
                            <td>{{ $leave->total_leave_days }}</td>
                            <td>
                                {{-- <a href="{{ url('edit/leaves/'.$leave->id) }}" class="btn btn-primary">Edit</a> --}}
                                <a href="{{ url('show/leaves/' . $leave->id) }}" class="btn btn-primary">show</a>
                                <a href="{{ url('delete-employes/' . $leave->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> --}}
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src=" https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src=" https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src=" https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src=" https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script>
        // $(document).ready(function() {
        // 	$('#myTable').DataTable();
        // });

        $(document).ready(function() {
            $('#myTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            });
        });
    </script>
@endsection
