<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class MonitorController extends Controller
{
    public function index()
    {  $today = date('Y-m-d');
       $bg_records= DB::select ('select * from barriergate  WHERE DATE(timestamp) = ? ORDER BY timestamp DESC ',[$today]);
       $residents = DB::select('select name from users INNER JOIN registered_vehicle on users.id = registered_vehicle.user_id');






        return view('admin.monitor')->with('bg_records', $bg_records);


    }
    //
}
