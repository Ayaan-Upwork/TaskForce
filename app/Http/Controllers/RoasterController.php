<?php

namespace App\Http\Controllers;

use App\Mail\RoasterSetEmail;
use App\Models\Employe;
use App\Models\Leave;
use App\Models\Location;
use App\Models\Roaster;
use App\Models\RoasterDetail;
use App\Models\Shift;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use stdClass;
use DB;

class RoasterController extends Controller
{
    public function add()
    {
        $roasterDate = Roaster::orderBy("id","desc")->get()->first();
        $employes = Employe::all();
        $locations = Location::all();
        // $shifts = Shift::all();
        return view('admin.roaster.add', compact('employes', 'locations', 'roasterDate'));
    }

    public function index()
    {
        $roasters = Roaster::with('employees')->get();
        // return $roasters;
        return view('admin.roaster.index', compact('roasters'));
    }

    public function deleteAll(){

        DB::beginTransaction();
        try{
            DB::table('roasters')->delete();
            DB::table('roaster_details')->delete();

            DB::commit();
            return redirect()->back()->with('Success','All Records Deleted Succcessfully');
        } catch(\Exception $e){
            return redirect()->back()->with('error','An Error occured while deleting records.');
        }
        
    }

    public function filterViaDatePersonal(Request $request)
    {

        $from = date("Y-m-d", strtotime($request->start_date));
        $to = date("Y-m-d", strtotime($request->end_date));
        $emp_id = $request->emp_id;
        $current_date = Carbon::now()->format('d-m-Y');
        $employees = Employe::where('id', $emp_id)->with(['roasters.details'  => function ($q) use ($from, $to) {
            $q->whereBetween('daily_date', [$from, $to])->whereNotNull('end_time');
        }])->first();

        $days = 0;
        $totalHours = 0;

        $days = 0;
        $time = 0;
        $finalTime = 0;
        foreach ($employees->roasters as $key => $roaster) {
            foreach ($roaster->details as $key => $detail) {
                $detail->locations;
                $days++;
                $from_time = strtotime($detail->daily_date . " " . $detail->start_time);
                $to_time = strtotime($detail->daily_date . " " . $detail->end_time);
                $time = round(abs($to_time - $from_time) / 60, 2);
                $detail->dailyTime = $time;
                $finalTime += $time;
            }
        }
        $employees->days = $days;
        $employees->time = $finalTime;

        return view('admin.roaster.showEmployeeReportFilter', compact('employees', 'from', 'to'));
    }

    public function testing()
    {

        // $startdate = '2022-06-10';
        // $enddate = '2022-06-25';
        // $startdate = date("d-m-Y", strtotime($startdate));
        // $enddate = date("d-m-Y", strtotime($enddate));


        //     $emp_id = 1;


        // $leave_check = Leave::where('employe_id', '=', $emp_id)->first();
        // if ($leave_check) {
        //     $leaveStartDate = date("d-m-Y", strtotime($leave_check->start_date));
        //     $leaveEndDate = date("d-m-Y", strtotime($leave_check->end_date));
        //     $start_date = Carbon::now()->format('d-m-Y');
        //     //  10-6-2022 lessEqual 16-8-2022     25-8-2022 big 8-6-2022         8-6-2022  biger 10-6-2022
        //     if ($startdate <= $leaveEndDate &&  $enddate >= $leaveStartDate && $leaveStartDate >= $startdate) {
        //         // this scenario works for when employee is on leave
        //         return "This Employee is Unavailable For Roaster Because he is on leave";
        //         // return redirect('/roasters')->with('status', "This Employee is Unavailable For Roaster Because he is on leave");
        //     }
        //     // this condition for use if the leave comming in between dates like
        //     // like employee apply for leave and roaster sets but leave is between the date
        //     // roaster set 24-6-2022 to 30-6-2022 and  leaves come in between 26- to 28
        //     //       10-6-2022  greater  8-6-2022  =  16-6-2022 greater 16-8-2022
        //     else if ($startdate > $leaveStartDate &&  $enddate > $leaveEndDate) {
        //         $dates = [
        //             ['start_Date_dollar' => $leaveStartDate],
        //             ['end_Date_dollar' => $leaveEndDate],
        //         ];
        //         $testarray = [];

        //         for ($i = 1; $i < 8; $i++) {
        //             # code...
        //             $testarray = [
        //                 [
        //                     $i => 'no',
        //                 ]
        //             ];
        //         }


        //         return $testarray;
        //     }
        //     //      10-6-2022 less 12-6-2022           16-8-2022    big 25-6-2022
        //     // this condition for if end date will be come in while roasters is set
        //     else {
        //         return "availbe";
        //     }
        // }
    }

    public function checkRoaster(Request $request)
    {
        $checkRoaster = Roaster::where('emp_id', '=', $request->emp_id)->where('from_date', '=', $request->startdate)->first();
        if ($checkRoaster) {
            // 1 mean roaster exist
            // return 1;
            return \response()->json('Roaster exist');
        }
        // else
        else {
            // 0 mean roaster not set
            return 0;
        }
    }

    public function insert(Request $request)
    {


        $roaster = new Roaster();
        $roaster = Roaster::create([
            'emp_id'  => $request->emp_id,
            'from_date'  => $request->start_date,
            'to_date'  => $request->end_date,
            'description' => $request->description
        ]);

        $location_ids = $request->location_id;
        $dateForRoasterDetails = $request->start_date_single;
        $startTime = $request->start_time;
        $endTime = $request->end_time;
        // =================
        $startdate = date("d-m-Y", strtotime($request->start_date));
        $enddate = date("d-m-Y", strtotime($request->end_date));
        $roasterdailyDate = $request->start_date_single;
        $leave_check = Leave::where('employe_id', '=', $request->emp_id)->first();

        // =================
        for ($i = 0; $i < 7; $i++) {
            $roasterdailyDatenew  =   $roasterdailyDate[$i];
            $roasterdailyDatenew = date("Y-m-d", strtotime($roasterdailyDatenew));
            if ($leave_check) {
                $leaveStartDate = date("Y-m-d", strtotime($leave_check->start_date));
                $leaveEndDate = date("Y-m-d", strtotime($leave_check->end_date));

                if ($roasterdailyDatenew <= $leaveStartDate  && $leaveEndDate >= $roasterdailyDatenew || $roasterdailyDatenew >= $leaveStartDate  && $leaveEndDate >= $roasterdailyDatenew) {

                    if ($roasterdailyDatenew == $leaveStartDate || $roasterdailyDatenew == $leaveEndDate) {
                        $roasterDetails = RoasterDetail::create([
                            'roaster_id' => $roaster->id,
                            'daily_date' => $roasterdailyDatenew
                        ]);
                    } else {


                        $roasterDetails = RoasterDetail::create([
                            'roaster_id' => $roaster->id,
                            'location_id' => $location_ids[$i],
                            'daily_date' => $roasterdailyDatenew,
                            'start_time' => $startTime[$i],
                            'end_time' => $endTime[$i],
                        ]);
                    }
                } else {

                    $roasterDetails = RoasterDetail::create([
                        'roaster_id' => $roaster->id,
                        'location_id' => $location_ids[$i],
                        'daily_date' => $roasterdailyDatenew,
                        'start_time' => $startTime[$i],
                        'end_time' => $endTime[$i],
                    ]);
                }
            } else {
                $roasterDetails = RoasterDetail::create([
                    'roaster_id' => $roaster->id,
                    'location_id' => $location_ids[$i],
                    'daily_date' => $roasterdailyDatenew,
                    'start_time' => $startTime[$i],
                    'end_time' => $endTime[$i],
                ]);
            }
        }
        $employee = Employe::find($request->emp_id);

        $roasterDetails =  RoasterDetail::with('locations')->where('roaster_id', $roaster->id)->get();
        Mail::to($employee->employe_email)->send(new RoasterSetEmail($roasterDetails, $employee));
        return redirect(url('roasters'));
    }

    public function viewReportViaDate(Request $request)
    {
        $from = date("Y-m-d", strtotime($request->start_date));
        $to = date("Y-m-d", strtotime($request->end_date));


        $current_date = Carbon::now()->format('d-m-Y');
        $employees = Employe::with(['roasters.details'  => function ($q) use ($from, $to) {
            $q->whereBetween('daily_date', [$from, $to])->whereNotNull('end_time');
        }])->get();

        $days = 0;
        $totalHours = 0;
        $employeeWorkHours = [];
        foreach ($employees as $key => $employee) {
            $workHours = 0;
           $days = 0;
           /* 
            $time = 0;
            $finalTime = 0;
            foreach ($employee->roasters as $key => $roaster) {
                foreach ($roaster->details as $detail) {
                    $days++;
                    $from_time = strtotime($detail->daily_date . " " . $detail->start_time);
                    $to_time = strtotime($detail->daily_date . " " . $detail->end_time);
                    $time = round(abs($to_time - $from_time) / 3600, 2);
                    $finalTime += $time;
                }
            }
            $employee->days = $days;
            $employee->time = $finalTime;*/
             foreach ($employee->roasters as $roaster) {
            foreach ($roaster->details as $detail) {
                $days++;
                $startTime = Carbon::parse($detail->start_time);
                $endTime = Carbon::parse($detail->end_time);
                $workHours += $endTime->diffInHours($startTime);
            }
        }

        /*$employeeWorkHours[] = [
            'employee' => $employee->name,
            'work_hours' => $workHours
        ];*/
        $employee['work_hours'] = $workHours;
        $employee['work_days'] = $days;
        }

        return view('admin.roaster.viewReportViaDate', compact('employees', 'from', 'to'));
    }



    public function report()
    {
        $employees = Employe::with('roasters.details')->get();
        foreach ($employees as $employee) {
            $days = 0;
            $time = 0;
            $finalTime = 0;
            foreach ($employee->roasters as $roaster) {
                foreach ($roaster->details as $detail) {
                    if (isset($detail->start_time)) {
                        $days++;
                        // $from_time = strtotime("2008-12-12 23:00:00");
                        $from_time = strtotime($detail->daily_date . " " . $detail->start_time);
                        $to_time = strtotime($detail->daily_date . " " . $detail->end_time);
                        // $from_time = strtotime("2008-12-12 23:00:00");
                        // $to_time = strtotime("2008-12-13 01:00:00");

                        $time = round(abs($to_time - $from_time) / 3600, 2);
                        $finalTime += $time;
                    }
                }
            }
            $employee->days = $days;
            $employee->time = $finalTime;
        }
        return view('admin.roaster.viewReport', compact('employees'));
    }

    public function delete($id)
    {
        $roaster = Roaster::find($id);
        $roaster->delete();
        return redirect('/roasters')->with('status', "Roaster Deleted Succcessfully");
    }

    public function update(Request $request, $id)
    {
        $roaster = Roaster::find($id);
        $roaster->emp_id = $request->emp_id;
        $roaster->location_id = $request->location_id;
        $roaster->shift_id = $request->shift_id;
        $roaster->from_date = $request->start_date;
        $roaster->to_date = $request->end_date;
        $roaster->description = $request->description;
        $roaster->update();
        if ($roaster) {
            return redirect('/roasters')->with('status', "Roaster Updated Succcessfully");
        } else {
            return redirect('/roasters');
        }
    }

    public function show($id)
    {
        $roaster = Roaster::where('id', $id)->first();
        $roastersDetails = RoasterDetail::where('roaster_id', $id)->with('locations')->get();
        // return $roasters;
        return view('admin.roaster.show', compact('roastersDetails', 'roaster'));
    }
    public function edit($id)
    {
        $roaster = Roaster::where('id', $id)->with('employees', 'shifts', 'locations')->first();
        $employes = Employe::all();
        $locations = Location::all();
        $shifts = Shift::all();
        return view('admin.roaster.edit', compact('roaster', 'employes', 'locations', 'shifts'));
    }


    public function showRoaster($id)
    {

        $employees = Employe::where('id', $id)->with(['roasters.details.locations'])->first();

        $days = 0;
        $time = 0;
        $finalTime = 0;
        foreach ($employees->roasters as $key => $roaster) {
            foreach ($roaster->details as $detail) {
                if (isset($detail->start_time)) {
                    $days++;
                    $from_time = strtotime($detail->daily_date . " " . $detail->start_time);
                    $to_time = strtotime($detail->daily_date . " " . $detail->end_time);
                    $time = round(abs($to_time - $from_time) / 3600, 1);
                    $detail->dailyCalculateTime = $time;
                    $finalTime += $time;
                }
            }
        }
        $employees->days = $days;
        $employees->time = $finalTime;

        return view('admin.roaster.viewReportViaDatePersonal', compact('employees'));
    }

    function getDatesFromRange($start, $end, $format = 'Y-m-d')
    {
        $startCheck = new DateTime($start);


        $array = array();
        $interval = new DateInterval('P1D');

        $realEnd = new DateTime($end);
        $realEnd->add($interval);

        $period = new DatePeriod(new DateTime($start), $interval, $realEnd);


        $totalFriday = 0;
        foreach ($period as $date) {
            $object  =  new stdClass();
            $object->day = $date->format('l');
            $object->date = $date->format($format);
            if ($object->day == 'Friday') {
                $object->new_line = true;
                $totalFriday = $totalFriday + 1;
            } else {
                $object->new_line = false;
            }


            $array[] = $object;
        }

        $object  =  new stdClass();
        $object->dates = $array;
        $object->start_day = $startCheck->format('l');
        if ($object->start_day == 'Friday') {
            $object->start_day_difference = 0;
        }
        if ($object->start_day == 'Saturday') {
            $object->start_day_difference = 1;
        }
        if ($object->start_day == 'Sunday') {
            $object->start_day_difference = 2;
        }
        if ($object->start_day == 'Monday') {
            $object->start_day_difference = 3;
        }
        if ($object->start_day == 'Tuesday') {
            $object->start_day_difference = 4;
        }
        if ($object->start_day == 'Wednesday') {
            $object->start_day_difference = 5;
        }
        if ($object->start_day == 'Thursday') {
            $object->start_day_difference = 6;
        }
        $object->total_friday = $totalFriday;
        $object->all_days = ['Friday', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday'];

        return $object;
    }
    public function checkLeaves(Request $request)
    {
      $employeeId = $request->input('employeeId');
      $dates = [];
      // Get the leave dates for the employee
      $leaves = Leave::where('employe_id', $employeeId)->get(); 
        foreach($leaves as $leave) {
            $period = \Carbon\CarbonPeriod::create($leave->start_date, $leave->end_date);
            $period_formated = [];
            foreach($period as $p) {
                $p = $p->format('Y-m-d');
                $period_formated[] = $p;
            }
            $dates = array_merge($dates,$period_formated);
        }

      // Return the leave dates as a JSON response
      return response()->json($dates);
    }

}
