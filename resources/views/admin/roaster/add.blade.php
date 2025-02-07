@extends('layouts.admin')
<title>Roaster</title>
@section('content')

    <div class="card">
        <div class="card-header">
            <h4>Add Roaster</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('roaster/insert') }}" method="POST">
                @csrf
                <div class="row">

                    {{-- <div class="col-md-12 mb-3">
                        <label>Select Location</label>
                        <select class="form-select" name="location_id">
                            <option value="">Select a Location</option>
                            @foreach ($locations as $location)
                                <option value="{{ $location->id }}"> {{ $location->address }} </option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="col-md-6 mb-3">
                        <label>Start Date</label>
                        <input type="date" class="form-control" name="start_date" id="start_date" value="{{$roasterDate!=null?$roasterDate->from_date:''}}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>End Date</label>
                        <input type="date" class="form-control" name="end_date" id="end_date" value="{{$roasterDate!=null?$roasterDate->to_date:''}}" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Select Employee</label>
                        <select onchange="handleSelectChange(event)" class="form-select select2" name="emp_id">
                            <option value="">Select a Employee</option>
                            @foreach ($employes as $employe)
                                <option value="{{ $employe->id }}"> {{ $employe->employe_name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Any Description</label>
                        <input type="text" class="form-control" name="description">
                    </div>
                    {{-- ====================================================== --}}
                    {{-- ====================================================== --}}
                    {{-- ====================================================== --}}
                    {{-- ====================================================== --}}
                    {{-- ====================================================== --}}
                    <div class="row" id="roaster-details-div">

                        <div class="col-md-2 mb-3">
                            @for ($i = 0; $i < 7; $i++)
                                <label>Select Location</label>
                                <select class="form-select" name="location_id[]" id="location-{{ $i }}" required>
                                    <option value="">Select a Location</option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id }}"> {{ $location->address }} </option>
                                    @endforeach
                                </select>
                            @endfor
                        </div>
                        <div class="col-md-2 mb-3">
                            @for ($i = 0; $i < 7; $i++)
                                <label>Select Date</label>
                                <div class="form-control">
                                    <input type="text" name="start_date_single[]" size="15" id="date-{{ $i }}" readonly>
                                </div>
                            @endfor
                        </div>
                        <div class="col-md-2 mb-3">
                            @for ($i = 0; $i < 7; $i++)
                                <label>Select Start Time</label>
                                <div class="form-control">
                                    <input type="text" name="start_time[]" size="8" id="startTime-{{ $i }}" required>
                                </div>
                            @endfor
                        </div>
                        <div class="col-md-2 mb-3">
                            @for ($i = 0; $i < 7; $i++)
                                <label>Select End Time</label>
                                <div class="form-control">
                                    <input type="text" name="end_time[]" size="8" id="endTime-{{ $i }}" required>
                                </div>
                            @endfor
                        </div>
                        <div class="col-md-2 mb-3">
                            @for ($i = 1; $i <= 7; $i++)
                                <label>Day Off</label>
                                <div class="form-control">
                                    <input type="checkbox" name="enabled[]" id="disablecheck-{{ $i }}">
                                </div>
                            @endfor
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary" id="submitbtn">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var empIdGlobal = '';
        var startDateGlobal = '';
        var endDateGlobal = '';
        $(document).ready(function() {


             startDateGlobal = $("#start_date").val();
             endDateGlobal = $("#end_date").val();

            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0');
            var yyyy = today.getFullYear();

            today = yyyy + '-' + mm + '-' + dd;
            $('#start_date').attr('min', today);
            $('#end_date').attr('min', today);

            $('#submitbtn').prop('disabled', true);

            $("#roaster-details-div").hide();

        });


        function handleSelectChange(event) {
            var selectElement = event.target;
            var value = selectElement.value;
            empIdGlobal = value;
            // startDateGlobal

            if (startDateGlobal != '' && endDateGlobal != '') {
                let weekday = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                // let weekday = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat','Sun'];
                var day = weekday[new Date(startDateGlobal).getDay()];
                if (weekday[new Date(startDateGlobal).getDay()] != 'Fri') {
                    $("#roaster-details-div").hide();
                    toastr.error('Start Date Should be Friday');
                    return false;
                } else if (weekday[new Date(endDateGlobal).getDay()] != 'Thu') {
                    $("#roaster-details-div").hide();
                    toastr.error('End Date Should be Thursday');
                    return false;
                }

                const date1 = new Date(startDateGlobal);
                const date2 = new Date(endDateGlobal);
                const diffTime = Math.abs(date2 - date1);
                const diffDays = (Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1);
                if (diffDays != 7) {
                    $("#roaster-details-div").hide();
                    toastr.error('Select One Week Roaster Dates');
                    return false;
                }

                // ======================
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.checkEmployeRoaster') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        emp_id: empIdGlobal,
                        startdate: startDateGlobal
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result != 0) {
                            $("#roaster-details-div").hide();
                            toastr.error('Roaster Already On Runing');
                            return false;
                        } else {
                            // alert(result);
                        }

                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
                // ======================

                $("#roaster-details-div").show();
                $('#submitbtn').prop('disabled', false);
                var dates = getDates(startDateGlobal, endDateGlobal);
                for (let i = 0; i < dates.length; i++) {
                    var d = dates[i];
                    d = new Date(d);
                    var ids = "date-" + i;
                    // var datestring = ("0" + d.getDate()).slice(-2) + "/" + ("0"+(d.getMonth()+1)).slice(-2) + "/" + d.getFullYear();
                    var datestring = (("0" + (d.getMonth() + 1)).slice(-2) + "/" + ("0" + d.getDate()).slice(-2)) + "/" + d
                        .getFullYear();
                    document.getElementById(ids).value = datestring;
                }
                $.ajax({
                  url: "{{ route('admin.checkLeaves') }}",
                  type: 'POST',
                   data: {
                        employeeId: empIdGlobal,
                    },
            
                  headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                  dataType: 'json',
                  success: function(response) {
                    // Loop through each date in the shift form
                    for (let i = 0; i < dates.length; i++) {
                        var d = dates[i];
                        d = new Date(d);
                        var d =  d
                        .getFullYear()+ '-'+(("0" + (d.getMonth() + 1)).slice(-2) + "-" + ("0" + d.getDate()).slice(-2));
                        console.log(d)

                      // Check if the date is in the response data
                      if (response.includes(d)) {
                        // Disable the date input if there is a leave on that date
                        document.getElementById('disablecheck-'+(i+1)).checked = true;
                      }
                    }
                  }
              });
            } else if (startDateGlobal == '') {
                toastr.error('Please select Start Date');
            } else if (endDateGlobal == '') {
                toastr.error('Please select End Date');
            }
        }
        $("#start_date").on("change", function() {
            startDateGlobal = $(this).val();
        });

        $("#end_date").on("change", function() {
            endDateGlobal = $(this).val();
        });

        Date.prototype.addDays = function(days) {
            var date = new Date(this.valueOf());
            date.setDate(date.getDate() + days);
            return date;
        }

        function getDates(startDate, stopDate) {
            var dateArray = new Array();
            var currentDate = startDate;
            while (currentDate <= stopDate) {
                dateArray.push(new Date (currentDate));
                currentDate = currentDate.addDays(1);
            }
            return dateArray;
        }

        //==========================
        function getDates(startDate, endDate, steps = 1) {
            const dateArray = [];
            let currentDate = new Date(startDate);

            while (currentDate <= new Date(endDate)) {
                var newDate = new Date(currentDate);
                dateArray.push(newDate.getFullYear() + '-' + (newDate.getMonth() + 1) + '-' + (newDate.getDate()));
                // Use UTC date to prevent problems with time zones and DST
                currentDate.setUTCDate(currentDate.getUTCDate() + steps);
            }

            return dateArray;
        }


        $('#disablecheck-1').change(function() {
            // alert('1 Checkbox checked!');
            $('#location-0').removeAttr('required');
            $('#startTime-0').removeAttr('required');
            $('#endTime-0').removeAttr('required');
            $("#location-0").val("");
            $("#startTime-0").val("");
            $("#endTime-0").val("");
        });
        $('#disablecheck-2').change(function() {
            // alert('2 Checkbox checked!');
            $('#location-1').removeAttr('required');
            $('#startTime-1').removeAttr('required');
            $('#endTime-1').removeAttr('required');
            $("#location-1").val("");
            $("#startTime-1").val("");
            $("#endTime-1").val("");
        });
        $('#disablecheck-3').change(function() {
            // alert('3 Checkbox checked!');
            $('#location-2').removeAttr('required');
            $('#startTime-2').removeAttr('required');
            $('#endTime-2').removeAttr('required');
            $("#location-2").val("");
            $("#startTime-2").val("");
            $("#endTime-2").val("");
        });
        $('#disablecheck-4').change(function() {
            // alert('4 Checkbox checked!');
            $('#location-3').removeAttr('required');
            $('#startTime-3').removeAttr('required');
            $('#endTime-3').removeAttr('required');
            $("#location-3").val("");
            $("#startTime-3").val("");
            $("#endTime-3").val("");
        });
        $('#disablecheck-5').change(function() {
            // alert('5 Checkbox checked!');
            $('#location-4').removeAttr('required');
            $('#startTime-4').removeAttr('required');
            $('#endTime-4').removeAttr('required');
            $("#location-4").val("");
            $("#startTime-4").val("");
            $("#endTime-4").val("");
        });
        $('#disablecheck-6').change(function() {
            // alert('6 Checkbox checked!');
            $('#location-5').removeAttr('required');
            $('#startTime-5').removeAttr('required');
            $('#endTime-5').removeAttr('required');
            $("#location-5").val("");
            $("#startTime-5").val("");
            $("#endTime-5").val("");
        });
        $('#disablecheck-7').change(function() {
            // alert('7 Checkbox checked!');
            $('#location-6').removeAttr('required');
            $("#location-6").val("");
            $('#startTime-6').removeAttr('required');
            $("#startTime-6").val("");
            $('#endTime-6').removeAttr('required');
            $("#endTime-6").val("");
        });




        for(var i=0; i<7;i++){
            $('#startTime-'+i).datetimepicker({
                value: '00:00',
                datepicker: false,
                format: 'H:i',
                step: 30,
        });
        }

        for(var i=0; i<7;i++){
            $('#endTime-'+i).datetimepicker({
                value: '00:00',
                datepicker: false,
                format: 'H:i',
                step: 05,
        });
        }


        
        //==========================
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2({
            closeOnSelect: true
        });
        });
    </script>
@endsection
