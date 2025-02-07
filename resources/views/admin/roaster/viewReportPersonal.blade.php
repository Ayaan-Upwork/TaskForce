@extends('layouts.admin')
<title>Roaster</title>
@section('links')

<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection
@section('content')

    <div class="row card">
        <div class="card-header">
             <h4>Employee Hours Report</h4>
            {{-- <div class="row col-md-2">
                <a href="{{ url('roaster/add') }}" class="btn btn-primary">Add roaster</a>
            </div> --}}
            <form action="{{ url('roasterpersonal/reportViaDatePersonal/'.$employee->id) }}">
                <div class="row">
                <div class="col-md-2">
                    <label>Start Date</label>
                    <input type="date" name="start_date">
                </div>
                <div class="col-md-2">
                    <label>End Date</label>
                    <input type="date" name="end_date">
                </div>
                <div class="col-md-2 mt-4">
                    <input type="submit" value="Filter Record">
                </div>
                </div>
                </form>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="myTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Employee Name</th>
                        <th>Employee Email</th>
                        <th>Employee Number</th>
                        <th>Total Working Days</th>
                        <th>Total Working Hours</th>
                        {{-- <th>Show</th> --}}
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->employe_name }}</td>
                        <td>{{ $employee->employe_email }}</td>
                        <td>{{ $employee->employe_number }}</td>
                        <td>{{ $employee->days }}</td>
                        <td>{{ $employee->hours }}</td>
                        {{-- <td><a href="{{ url('show/roasterpersonal/'.$employee->id) }}" class="btn btn-primary">show</a></td> --}}
                    </tr>
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
    $('#myTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
} );
</script>
@endsection
