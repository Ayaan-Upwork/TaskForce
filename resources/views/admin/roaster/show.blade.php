@extends('layouts.admin')
<title>Roaster</title>
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>View Location</h4>
        </div>
        <div class="card-header">
            <h4>Employee Name : {{ $roaster->employees->employe_name}}</h4>
        </div>
        <div class="card-header">
            <h4>Roaster Start Date : {{ $roaster->from_date}}</h4> <h4>Roaster End Date : {{ $roaster->to_date}}</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="myTable">
                <thead>
                    <tr>
                        <th>S No</th>
                        <th>Location</th>
                        <th>Roaster Daily Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roastersDetails as $key =>  $roastersDetail)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>{{ $roastersDetail->locations->address ?? 'No Roaster Set' }}</td>
                        <td>{{ $roastersDetail->daily_date ?? 'No Roaster Set' }}</td>
                        <td>{{ $roastersDetail->start_time ?? 'No Roaster Set' }}</td>
                        <td>{{ $roastersDetail->end_time ?? 'No Roaster Set' }}</td>
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
