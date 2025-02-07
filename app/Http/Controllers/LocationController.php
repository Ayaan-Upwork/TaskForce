<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        return view('admin.location.index',compact('locations'));
    }
    public function insert(Request $request)
    {
        // return $request->all();
        $location = new Location();
        $location->city = $request->city;
        $location->client_name = $request->client;
        $location->state = $request->state;
        $location->address = $request->address;
        $location->save();
        if($location)
        {
            return redirect('/locations')->with('status',"Location Updated Succcessfully"); 
        }
        else
        {
            return redirect('/locations');
        }
    }
    public function add()
    {
        return view('admin.location.add');
    }

    public function edit($id)
    {
        $location = Location::find($id);
        return view('admin.location.edit',compact('location'));
    }

    public function update(Request $request,$id)
    {
        $location = Location::find($id);
        $location->state = $request->input('state');
        $location->client_name = $request->input('client');
        $location->city = $request->input('city');
        $location->address = $request->input('address');
        $location->update();
        if($location)
        {
            return redirect('/locations')->with('status',"Location Updated Succcessfully"); 
        }
        else
        {
            return redirect('/locations');
        }
    }

    public function delete($id){
        $location = Location::find($id);
        $location->delete();
        return redirect('/locations')->with('status',"Location Deleted Succcessfully"); 
    }
 
    public function show($id)
    {
        $location = Location::find($id);
        return view('admin.location.show',compact('location'));
    }
    
}
 