<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Roaster;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeStoreReqeust;
use App\Http\Requests\EmployeStoreRequest;
use App\Http\Requests\UpdateEmployeReqeust;

class EmployeController extends Controller
{
    public function index()
    {
        // $employes = Employe::all();
        // return view('admin.employe.index', compact('employes'));
        $date = Carbon::now()->format('Y-m-d');
        $employes = Employe::all();
        foreach ($employes as $employe) {
            $employe->roaster = Roaster::orderBy('created_at', 'desc')->where('emp_id', $employe->id)->whereDate('to_date', '>=', $date)->with('location')->first();
        }
        // return $employes;
        return view('admin.employe.index', compact('employes'));
    }
   
    public function insert(EmployeStoreRequest $request)
    {
        // return $request->all();
        $employe = new Employe();
        $employe->employe_name = $request->employe_name;
        $employe->employe_email = $request->employe_email;
        $employe->employe_number = $request->employe_number;
        $employe->employe_address = $request->employe_address;
        $employe->employe_status = $request->employe_status;
        $employe->save();

        if ($employe) {
            return redirect('/employes')->with('status', "Employe Saved Succcessfully");
        } else {
            return redirect('/employes');
        }
    }
    public function add()
    {
        return view('admin.employe.add');
    }

    public function edit($id)
    {
        $employe = Employe::find($id);
        return view('admin.employe.edit', compact('employe'));
    }

    public function update(UpdateEmployeReqeust $request, $id)
    {
        // return $request->all();
        $employe = Employe::find($id);
        $employe->employe_name = $request->input('employe_name');
        $employe->employe_email = $request->input('employe_email');
        $employe->employe_number = $request->input('employe_number');
        $employe->employe_address = $request->input('employe_address');
        $employe->update();
        if ($employe) {
            return redirect('/employes')->with('status', "Employe Saved Succcessfully");
        } else {
            return redirect('/employes');
        }
    }

    public function delete($id)
    {
        $employe = Employe::find($id);
        $employe->delete();
        return redirect('/employes')->with('status', "Employe Deleted Succcessfully");
    }

    public function show($id)
    {
        $employe = Employe::find($id);
        return view('admin.employe.show', compact('employe'));
    }
}
