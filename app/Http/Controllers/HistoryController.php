<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{

    public function index()
    {

        $user_id = Auth::user()->id;
        $records = DB::select('select * from users where id = ?',[$user_id]);
        $cars = DB::select('select * from registered_vehicle where user_id = ?',[$user_id]);

       return view('resident.history',compact('records','cars'));
    }

    public function gethistory(Request $request)
    {
        $user_id = Auth::user()->id;
        $records = DB::select('select * from users where id = ?',[$user_id]);
        $cars = DB::select('select * from registered_vehicle where user_id = ?',[$user_id]);
        $lp = $request->cars;

        $history = DB::select('select * from barriergate where lp = ? ORDER BY timestamp DESC ',[$lp]);

        return view('resident.history',compact('records','cars','history'));

    }
    //
}
