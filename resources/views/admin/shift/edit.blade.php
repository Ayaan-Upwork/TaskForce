@extends('layouts.admin')
<title>Shift</title>
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Edit Shift</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('shifts/update/'.$shift->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Shift Name</label>
                        <input type="text" class="form-control" name="shift_name" value="{{ $shift->shift_name }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Start Time</label>
                        {{-- <input type="time" class="form-control" name="start_time" value="{{ $shift->start_time }}" required> --}}
                        <input name="start_time" type="time" value="{{  date("H:i", strtotime($shift->start_time)) }}" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>End TIme</label>
                        <input name="end_time"  type="time" class="form-control" value="{{  date("H:i", strtotime($shift->end_time)) }}" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
