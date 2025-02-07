@extends('layouts.admin')
<title>Location</title>
@section('links')
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection
@section('content')
    <div class="row card">
        <div class="card-header">
            <h4>Location Page</h4>
            <div class="row col-md-2">
                <a href="{{ url('locations/add') }}" class="btn btn-primary">Add Location</a>
            </div>
        </div>
        <div>
            <div class="card-body">
                <table class="table table-bordered table-striped" id="myTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Client</th>
                            <th>State</th>
                            <th>City</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($locations as $location)
                            <tr>
                                <td>{{ $location->id }}</td>
                                <td>{{ $location->client_name }}</td>
                                <td>{{ $location->state }}</td>
                                <td>{{ $location->city }}</td>
                                <td>{{ $location->address }}</td>
                                <td>
                                    <a href="{{ url('locations//edit/' . $location->id) }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ url('locations/show/' . $location->id) }}" class="btn btn-info">Show</a>
                                    <a href="{{ url('locations/delete/' . $location->id) }}"
                                        class="btn btn-danger">Delete</a>
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
