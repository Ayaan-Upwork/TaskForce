@extends('layouts.admin')
<title>Holidays</title>
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Edit Holiday</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('leaves/update/' . $leaves->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <select class="form-select" name="emp_id" required>
                            <option value="">Select a Employee</option>
                            @foreach ($employes as $employe)
                                <option value="{{ $employe->id }}"
                                    {{ $leaves->user->id == $employe->id ? 'selected' : '' }}> {{ $employe->employe_name }}
                                </option>
                                {{-- <option value="{{ $employe->id }}"> {{ $employe->employe_name }} </option> --}}
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Start Date</label>
                        <input type="date" class="form-control" value={{ $leaves->start_date }} name="start_date"
                            required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>End Date</label>
                        <input type="date" class="form-control" value={{ $leaves->end_date }} name="end_date" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Total Days of Holidays</label>
                        <input type="text" class="form-control" value={{ $leaves->total_leave_days }}
                            name="total_leave_days" required>
                    </div>


                    <div class="col-md-12 mb-3">
                        <label>Details</label>
                        <input type="text" class="form-control" value={{ $leaves->description }} name="description"
                            required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
