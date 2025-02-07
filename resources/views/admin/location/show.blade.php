@extends('layouts.admin')
<title>Location</title>
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>View Location</h4>
        </div>
        <div class="card-body">
            <form>
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>ID</label>
                        <input type="text" value="{{ $location->id }}" class="form-control" name="id" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Client Name</label>
                        <input type="text" value="{{ $location->client_name }}" class="form-control" name="id" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>State Name</label>
                        <input type="text" value="{{ $location->state }}" class="form-control" name="state" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>City Name</label>
                        <input type="text" value="{{ $location->city }}" class="form-control" name="city" disabled>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Address Deatis</label>
                        <textarea name="address"  cols="30" rows="5" class="form-control" disabled> {{ $location->address }} </textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
