@extends('layouts.admin')
<title>Location</title>
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Edit Locations</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('locations/update/'.$location->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Client Name</label>
                        <input type="text" value="{{ $location->client_name }}" class="form-control" name="client" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>State</label>
                        <input type="text" value="{{ $location->state }}" class="form-control" name="state" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>City</label>
                        <input type="text" value="{{ $location->city }}" class="form-control" name="city" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Address</label>
                        <textarea name="address"  cols="30" rows="5" class="form-control" required> {{ $location->address }} </textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
