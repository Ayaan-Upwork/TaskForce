@extends('layouts.admin')
<title>Shift</title>
@section('css')

{{-- <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"> --}}
{{-- <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" /> --}}

@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Shift Page</h4>
        </div>
        <div class="row col-md-2">
            <a href="{{ url('shifts/add') }}" class="btn btn-primary">Add Shift</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="myTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Shift Name</th>
                        <th>Shift Start TIme</th>
                        <th>Shift End Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shifts as $shift)
                    <tr>
                        <td>{{ $shift->id }}</td>
                        <td>{{ $shift->shift_name }}</td>
                        {{-- @php
                        $startTime = $shift->start_date;
                        $newTime = date('h:i A', strtotime($startTime));
                        @endphp --}}
                        <td>{{ 
                        $shift->start_time 
                        
                        }}</td>
                        <td>
                            {{-- @php
                            $endTime = $shift->end_date;
                            $newTime = date('h:i A', strtotime($endTime));
                            @endphp --}}
                            {{ $shift->end_time }}
                        </td>
                        <td>
                            <a href="{{ url('shifts/edit/'.$shift->id) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ url('shifts/show/'.$shift->id) }}" class="btn btn-info">Show</a>
                            <a href="{{ url('shifts/delete/'.$shift->id) }}" class="btn btn-danger">Delete</a>
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
{{-- <script src="https://nightly.datatables.net/buttons/js/dataTables.buttons.js?_=c6b24f8a56e04fcee6105a02f4027462"></script>     --}}

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
