<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\DB;


class BlacklistController extends Controller
{
    public function index()
    {
        $blacklists = DB::select('select * from blacklist ORDER by timestamp DESC ');
        return view('admin.blacklist')->with('blacklists',$blacklists);
    }

    public  function addbl(Request $request)
    {

        $lp = strtoupper($request->input('licenseplate')); //input is according to name in form

        $model = $request->input('model');
        $reason = $request->input('reason');
        $timestamp = \Carbon\Carbon::now()->toDateTimeString();

        $check = DB::select('select * from blacklist where lp = ?',[$lp]);

        if ($check == null)
        {
            $data=array('lp'=>$lp,"model"=>$model,"reason"=>$reason,"timestamp"=>$timestamp);
            $query = DB::table('blacklist')->insert($data);
            return Redirect::back()->with('blacklisted','added to blacklisted list');

        }
        else
        {
            return Redirect::back()->with('duplicated','vehicle is already in the list');
        }






    }
    //
}
