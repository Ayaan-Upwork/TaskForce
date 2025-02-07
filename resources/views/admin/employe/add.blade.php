@extends('layouts.admin')
<title>Employee</title>
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Add Employee</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('employes/insert')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Employee Name</label>
                        <input type="text" class="form-control @error('employe_name') parsley-error @enderror" name="employe_name" value="{{ old('employe_name') }}" required>
                        @error('employe_name')
                            <span class="text-red">{{ $message }}</span>
                            @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Employee Email</label>
                        <input type="email" class="form-control @error('employe_email') parsley-error @enderror" name="employe_email" value="{{ old('employe_email') }}" required>
                        @error('employe_email')
                            <span class="text-red">{{ $message }}</span>
                            @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Employee Number</label>
                        <input name="employe_number"  type="number" class="form-control @error('employe_number') parsley-error @enderror" value="{{ old('employe_number') }}" required>
                        @error('employe_number')
                            <span class="text-red">{{ $message }}</span>
                            @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Employee Address</label>
                        <textarea name="employe_address"  cols="30" rows="5" class="form-control @error('employe_address') parsley-error @enderror" required>{{ old('employe_address') }}</textarea>
                        @error('employe_address')
                            <span class="text-red">{{ $message }}</span>
                            @enderror
                    </div>
                    <input type="hidden" name="employe_status" value="1">
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
