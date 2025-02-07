<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Leave;
use App\Models\Roaster;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function add()
    {
        $employes = Employe::all();
        return view('admin.leave.index', compact('employes'));
    }

    public function report()
    {
        $employees = Employe::all();
        foreach ($employees as $key => $employee) {

            $employee->total_leaves = Leave::where('employe_id', $employee->id)->sum('total_leave_days');
        }

        return view('admin.leave.viewLeaveReport', compact('employees'));
    }



    public function leaveReportViaDate(Request $request)
    {
        $days = 0;
        $employees = Employe::all();
        $start_date = date("Y-m-d", strtotime($request->start_date));
        $end_date = date("Y-m-d", strtotime($request->end_date));
        foreach ($employees as $key => $employee) {
            $leaves = Leave::where('employe_id', $employee->id)->get();
            $days = 0;
            foreach ($leaves as $leave) {
                if ($leave->start_date >= $start_date &&  $leave->end_date <= $end_date) {

                    $start_database = $leave->start_date;
                    $end_database = $leave->end_date;
                    $date1 = new DateTime($start_database);
                    $date2 = new DateTime($end_database);

                    $interval = $date1->diff($date2);
                    $days = $days + $interval->d;
                } else if (($start_date > $leave->start_date && $end_date <= $leave->end_date)) {

                    $date1 = new DateTime($start_date);
                    $date2 = new DateTime($end_date);

                    $interval = $date1->diff($date2);
                    $days = $days + $interval->d;
                } else if ($leave->start_date < $start_date && $end_date >= $leave->end_date && $leave->end_date > $start_date) {
                    $date_end_datebase = $leave->end_date;
                    $date1 = new DateTime($start_date);
                    $date2 = new DateTime($date_end_datebase);
                    $interval = $date1->diff($date2);
                    $days = $days + $interval->d;
                } else if ($start_date <= $leave->start_date && $leave->end_date >= $end_date) {
                    $start_date_database =  $leave->start_date;
                    $date1 = new DateTime($start_date_database);
                    $date2 = new DateTime($end_date);

                    $interval = $date1->diff($date2);
                    $days = $days + $interval->d;
                }
            }
            $employee->total_leaves = $days + 1;
        }
        // return $employees;
        return view('admin.leave.viewLeaveReportViaDate', compact('employees', 'start_date', 'end_date'));
    }
    //01 - 31



    public function insert(Request $request)
    {
        // day difference works start
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $requestToDate = date("d-m-Y", strtotime($end_date));
        $requestFromDate = date("d-m-Y", strtotime($start_date));

        $from = date("Y-m-d", strtotime($request->start_date));
        $to = date("Y-m-d", strtotime($request->end_date));
        
        $roaster = Roaster::where('emp_id', $request->emp_id)->orderBy('created_at', 'desc')->first();
        // ==========================================================
        $roasterStartDate = date("Y-m-d", strtotime($roaster->from_date));
        $roasterEndDate = date("Y-m-d", strtotime($roaster->to_date));
        // ==========================================================
        //  roaster is set from 2-9-2022 to 8-9-2022
        
        // and we starting from 
        //  2-9-2022 to  5-9-2022
        //   2  less then  9        and  5 - greater 2          and   2 greater 3         
        if ($from <= $roasterEndDate &&  $to >= $roasterStartDate) {
            return  redirect()->back()->with('status', "You are not able to set leave because the employee's roaster is runing");
        }
        // else if ($from > $roasterStartDate &&  $to > $roasterEndDate) {
        // }
        // ==========================================================
        // ==========================================================
        // ==========================================================

     
        $leave_check = Leave::where('employe_id', '=', $request->emp_id)->orderBy('created_at', 'desc')->first();
        if ($leave_check) {
            $leaveStartDate = date("d-m-Y", strtotime($leave_check->start_date));
            $leaveEndDate = date("d-m-Y", strtotime($leave_check->end_date));


            $current_date = Carbon::now()->format('d-m-Y');
            // 6-9-2022 less then 8-9-2022
            if ($requestFromDate <= $leaveEndDate) {
                return redirect('/view-leaves')->with('status', "This Employee is already on holidays, So you cannot set");
            }
        }
        if ($requestFromDate > $requestToDate) {
            // return  redirect()->back()->with('status', "This Employee is Unavailable For this Date");
            return  redirect()->back()->with('status', "Start Date Should Be Less Then End Date");
        }
        // ======================================
        $datetime1 = new DateTime($start_date);
        $datetime2 = new DateTime($end_date);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');
        // day difference works end
        $leave = new Leave();
        $leave->employe_id  = $request->emp_id;
        $leave->start_date = $request->start_date;
        $leave->end_date = $request->end_date;
        $leave->total_leave_days = $days + 1;
        $leave->description = $request->detail;
        $leave->save();
        if ($leave) {
            // return redirect()->back()->with('status', "Leave Saved Succcessfully");
            return redirect()->route('home_leave')->with('status', "Leave Saved Succcessfully");
        } else {
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        // $leaves = Leave::find($id)->with('user');
        $leaves = Leave::where('id', $id)->with('user')->first();
        $employes = Employe::all();
        // return $employes;
        return view('admin.leave.edit', compact('leaves', 'employes'));
    }

    public function view()
    {
        $leaves = Leave::with('user')->get();
        return view('admin.leave.list', compact('leaves'));
    }

    public function show($id)
    {
        $leaves = Leave::where('id', $id)->with('user')->first();
        return view('admin.leave.show', compact('leaves'));
    }

    public function update(Request $request, $id)
    {
        $leave = Leave::find($id);
        $leave->employe_id  = $request->emp_id;
        $leave->start_date = $request->start_date;
        $leave->end_date = $request->end_date;
        $leave->total_leave_days = $request->total_leave_days;
        $leave->description = $request->description;
        $leave->update();
        return redirect('view-leaves')->with('status', "Leave Updated Succcessfully");
    }

    public function leaveReportViaPersonal($id)
    {
        $employee = Employe::where('id', $id)->first();
        $employee->total_leaves = Leave::where('employe_id', $employee->id)->sum('total_leave_days');
        // return $employee;
        return view('admin.leave.show_by_Id', compact('employee'));
    }

    public function leaveReportViaDatePersonal(Request $request, $id)
    {
        $days = 0;
        $employee = Employe::where('id', $id)->first();
        $start_date = date("Y-m-d", strtotime($request->start_date));
        $end_date = date("Y-m-d", strtotime($request->end_date));
        $leaves = Leave::where('employe_id', $employee->id)->get();

        $days = 0;
        foreach ($leaves as $leave) {
            if ($leave->start_date >= $start_date &&  $leave->end_date <= $end_date) {

                $start_database = $leave->start_date;
                $end_database = $leave->end_date;
                $date1 = new DateTime($start_database);
                $date2 = new DateTime($end_database);

                $interval = $date1->diff($date2);
                $days = $days + $interval->d;
            } else if (($start_date > $leave->start_date && $end_date <= $leave->end_date)) {

                $date1 = new DateTime($start_date);
                $date2 = new DateTime($end_date);

                $interval = $date1->diff($date2);
                $days = $days + $interval->d;
            } else if ($leave->start_date < $start_date && $end_date >= $leave->end_date && $leave->end_date > $start_date) {
                $date_end_datebase = $leave->end_date;
                $date1 = new DateTime($start_date);
                $date2 = new DateTime($date_end_datebase);
                $interval = $date1->diff($date2);
                $days = $days + $interval->d;
            } else if ($start_date <= $leave->start_date && $leave->end_date >= $end_date) {
                $start_date_database =  $leave->start_date;
                $date1 = new DateTime($start_date_database);
                $date2 = new DateTime($end_date);

                $interval = $date1->diff($date2);
                $days = $days + $interval->d;
            }
        }
        $employee->total_leaves = $days + 1;
        // return $employee;
        return view('admin.leave.viewLeaveByIdPersonal', compact('employee', 'start_date', 'end_date'));
    }

    public function delete($id)
    {
        $leave = Leave::find($id)->delete();
        return redirect()->back()->with('status', "Leave Deleted Succcessfully");;
    }
}
