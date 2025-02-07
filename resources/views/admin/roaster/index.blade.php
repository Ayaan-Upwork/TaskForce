@extends('layouts.admin')
<title>Roaster</title>
@section('links')
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection
@section('content')
    <div class="row card">
        <div class="card-header">
            <h4>Roaster Page</h4>
            <div class="row d-flex justify-content-between">
                <div class="col-md-2">
                    <a href="{{ url('roaster/add') }}" class="btn btn-primary">Add roaster</a>
                </div>
                <div class="col-md-2">
                    <a href="{{ url('roaster/deleteAll') }}" class="btn btn-danger">Delete Record</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="myTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Employe Name</th>
                        <th>Roaster Start Date</th>
                        <th>Roaster End Date</th>
                        <th>Description</th>
                        {{-- <th>View Details</th> --}}
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roasters as $roaster)
                        <tr>
                            <td>{{ $roaster->id }}</td>
                            <td>{{ $roaster->employees->employe_name }}</td>
                            <td>{{ $roaster->from_date }}</td>
                            <td>{{ $roaster->to_date }}</td>
                            <td>{{ $roaster->description }}</td>
                            {{-- <td>{{ $roaster->id }}</td> --}}
                            <td>
                                {{-- <a href="{{ url('roaster/edit/'.$roaster->id) }}" class="btn btn-primary">Edit</a> --}}
                                <a href="{{ url('roaster/show/' . $roaster->id) }}" class="btn btn-info">Show</a>
                                <a href="{{ url('roaster/delete/' . $roaster->id) }}" class="btn btn-danger">Delete</a>
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
