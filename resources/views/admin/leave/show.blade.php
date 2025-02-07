@extends('layouts.admin')
<title>Holidays</title>
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>View Employee Holiday</h4>
        </div>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        
                        <label>Employee Name</label>
                        <input type="text" class="form-control" value={{$leaves->user->employe_name}} disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Start Date</label>
                        <input type="date" class="form-control" value={{$leaves->start_date}} disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>End Date</label>
                        <input type="date" class="form-control" value={{$leaves->end_date}} disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Total Holidays</label>
                        <input type="text" class="form-control" value={{$leaves->total_leave_days}} disabled>
                    </div>


                    <div class="col-md-12 mb-3">
                        <label>Details</label>
                        <input type="text" class="form-control" value={{$leaves->description}} disabled>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
