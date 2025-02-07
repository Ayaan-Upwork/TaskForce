<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{

    public function insert(Request $request)
    {
        $shift = new Shift();   
        $shift->shift_name = $request->shift_name;
        $shift->start_time = $request->start_time;
        $shift->end_time = $request->end_time;
        $shift->save();
        if($shift)
        {
            return redirect('/shifts')->with('status',"Shift Added Succcessfully"); 
        }
        else
        {
            return redirect('/shifts'); 
        }
    }

    public function index()
    {
        $shifts = Shift::all();
        return view('admin.shift.index',compact('shifts'));

    }

    public function add()
    {
        return view('admin.shift.add');
        
    }

    public function edit($id)
    {
        $shift = Shift::find($id);
        return view('admin.shift.edit',compact('shift'));
    }

    public function update(Request $request,$id)
    {
        $shift = Shift::find($id);  
        $shift->shift_name = $request->shift_name;
        $shift->start_time = $request->start_time;
        $shift->end_time = $request->end_time;
        $shift->update();
        if($shift){
            return redirect('/shifts')->with('status',"Shift Updated Succcessfully"); 
        }
        else
        {
         return redirect('/shifts');
        }
    }

    public function show($id)
    {
        $shift = Shift::find($id);
        return view('admin.shift.show',compact('shift'));
    }
    public function delete($id){
        $shift = Shift::find($id);
        $shift->delete();
        return redirect('/shifts')->with('status',"Shift Deleted Succcessfully"); 
    }
}
