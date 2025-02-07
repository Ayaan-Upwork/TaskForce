@extends('layouts.admin')
<title>Roaster</title>
@section('links')
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection
@section('content')
    <div class="row card">
        <div class="card-header">
            <form action="{{ url('roaster/personal-filter') }}" method="get">
                <div class="row">
                    <div class="col-md-2">
                        <label>Start Date</label>
                        <input type="date" name="start_date">
                    </div>
                    <div class="col-md-2">
                        <label>End Date</label>
                        <input type="date" name="end_date">
                    </div>
                    <input type="hidden" value="{{ $employees->id }}" name="emp_id">
                    <div class="col-md-2 mt-4">
                        <input type="submit" value="Filter Record">
                    </div>
                </div>
            </form>


            <h4>Roaster Page</h4>
            {{-- <div class="row col-md-2">
                <a href="{{ url('roaster/add') }}" class="btn btn-primary">Add roaster</a>
            </div> --}}
            <div class="row">
                <div class="col-md-2">
                    <label>Employee Name : {{ $employees->employe_name }}</label>
                </div>
                <div class="col-md-4">
                    <label>Employee Email : {{ $employees->employe_email }}</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <label>Total Days : {{ $employees->days }}</label>
                </div>
                <div class="col-md-2">
                    <label>Total Hours : {{ $employees->time }}</label>
                </div>
            </div>


        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="myTable">
                <thead>
                    <tr>
                        <th>Location</th>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Total Working Hours</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees->roasters as $roaster)
                        @foreach ($roaster->details as $details)
                            @if ($details->start_time != null)
                                <tr>
                                    <td>{{ $details->locations->client_name }}</td>
                                    <td>{{ $details->daily_date }}</td>
                                    <td>{{ $details->start_time }}</td>
                                    <td>{{ $details->end_time }}</td>
                                    <td>{{ $details->dailyCalculateTime }}</td>
                                </tr>
                            @endif
                        @endforeach
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
