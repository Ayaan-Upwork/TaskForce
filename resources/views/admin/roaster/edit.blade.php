@extends('layouts.admin')
<title>Roaster</title>
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Edit Roaster</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('roaster/update/'.$roaster->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Select Employee</label>
                        <select class="form-select" name="emp_id">
                            {{-- <option value="">Select a Employee</option> --}}
                            @foreach ($employes as $employe)
                            {{-- <option value="{{ $employe->id }}"> {{ $employe->employe_name }} </option> --}}
                            <option value="{{ $employe->id }}" {{ ($roaster->employees->id == $employe->id ? "selected":"") }}> {{ $employe->employe_name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Select Location</label>
                        <select class="form-select" name="location_id">
                            <option value="">Select a Location (State)</option>
                            @foreach ($locations as $location)
                                <option value="{{ $location->id }}" {{ ($roaster->locations->id == $location->id ? "selected":"") }}> {{ $location->state }} </option>
                                {{-- <option value="{{ $location->id }}"> {{ $location->address }} </option> --}}
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Select Shift</label>
                        <select class="form-select" name="shift_id">
                            <option value="">Select a Shift</option>
                            @foreach ($shifts as $shift)
                               <option value="{{ $shift->id }}" {{ ($roaster->shifts->id == $shift->id ? "selected":"") }}> {{ $shift->shift_name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Start Date</label>
                        <input value="{{ $roaster->from_date }}" name="start_date" type="date" class="form-control" required/>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>End Date</label>
                        <input value="{{ $roaster->to_date }}"name="end_date" type="date" class="form-control" required/>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Any Description</label>
                        <input value="{{ $roaster->description }}" type="text" name="description" class="form-control" required/>
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
