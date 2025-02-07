@extends('layouts.admin')
<title>Employee</title>
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Edit Employee</h4>
        </div>
        <div class="card-body">
            <form >
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Employee ID</label>
                        <input type="text" class="form-control" value="{{ $employe->id }}" name="id" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Employee Name</label>
                        <input type="text" class="form-control" value="{{ $employe->employe_name }}" name="name" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Employee Email</label>
                        <input type="email" class="form-control" value="{{ $employe->employe_email }}" name="email" disabled>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Employee Number</label>
                        <input name="salary"  type="number" value="{{ $employe->employe_number }}" class="form-control" disabled>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Employee Address</label>
                        <textarea name="address"  cols="30" rows="5" class="form-control" disabled>{{ $employe->employe_address }}</textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
