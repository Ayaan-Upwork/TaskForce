<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employe;
use App\Models\Location;
use App\Models\Shift;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        // $shifts = Shift::count();
        $locations = Location::count();
        $employees = Employe::count();
        return view('admin.index',compact('locations','employees'));
    }
}
