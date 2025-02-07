@extends('layouts.admin')
<title>Holidays</title>
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                {{-- <div class="col-md-2">
                    <a href="{{ url('roaster/add') }}" class="btn btn-primary">Add roaster</a>
                </div> --}}
                   <h4>Holdiay Report Page</h4>
                <form action="{{ url('leave/reports/selectDates/personal/'.$employee->id) }}">
                    <div class="row">
                <div class="col-md-2">
                    <label>Start Date</label>&nbsp;&nbsp;&nbsp;
                    <input type="date" name="start_date">
                </div>
                <div class="col-md-2">
                    <label>End Date</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="date" name="end_date">
                </div>
                <div class="col-md-2 mt-4">
                    <input type="submit" value="Filter Record">
                </div>
                </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-md-12 mb-3">

                        <label>Employee Name</label>
                        <input type="text" class="form-control" value={{$employee->employe_name}} disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Employee Email</label>
                        <input type="text" class="form-control" value={{$employee->employe_email}} disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Employee Number</label>
                        <input type="text" class="form-control" value={{$employee->employe_number}} disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Employee Address</label>
                        <input type="text" class="form-control" value={{$employee->employe_address}} disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Total Holidays</label>
                        <input type="text" class="form-control" value={{$employee->total_leaves}} disabled>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
