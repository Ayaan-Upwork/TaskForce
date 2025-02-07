@extends('layouts.admin')
<title>Holidays</title>
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Add Holidays For Employees</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('insert-leaves') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <select class="form-select" name="emp_id" required>
                            <option value="">Select a Employee</option>
                            @foreach ($employes as $employe)
                                <option value="{{ $employe->id }}"> {{ $employe->employe_name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Details</label>
                        <input type="text" class="form-control" name="detail" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {

            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0');
            var yyyy = today.getFullYear();

            today = yyyy + '-' + mm + '-' + dd;
            $('#start_date').attr('min', today);
            $('#end_date').attr('min', today);
        });
    </script>
@endsection
