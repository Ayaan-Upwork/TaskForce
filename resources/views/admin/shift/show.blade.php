@extends('layouts.admin')
<title>Shift</title>
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Show Shift</h4>
        </div>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Shift Name</label>
                        <input type="text" class="form-control" name="shift_name" value="{{ $shift->shift_name }}" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Start Time</label>
                        <input type="text" class="form-control" name="start_time" value="{{ $shift->start_time }}" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>End TIme</label>
                        <input name="end_time"  type="text" class="form-control" value="{{ $shift->end_time }}" disabled>
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
