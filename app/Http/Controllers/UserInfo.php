<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class UserInfo extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;

        if ($role == 1)
        {
            $lps = DB::select('select id,name, COUNT(lp) from registered_vehicle INNER JOIN users ON registered_vehicle.user_id
        = users.id GROUP BY id,name' );

            $records = DB::select('select * from users where role = ?',[0]);



            return view('admin.resident_info')->with('records',$records);

        }
        else
        {
            return Redirect::back();
        }



    }

    public function profile($id)
    {
        $role = Auth::user()->role;


        if ($role == 1)
        {
            $profiles = DB::select('select * from users where id = ?',[$id]);
            $cars = DB::select('select * from registered_vehicle where user_id = ?',[$id]);

            $visitor = DB::select('select * from visitor where owner = ?',[$id]);
            $count = count($visitor);
            $count2 = count($cars);
            return view('admin.resident-detail',compact('profiles','cars','visitor','count','count2'));

        }
        else
        {
            return Redirect::back();
        }


    }
    public function details()
    {
        $role = Auth::user()->role;

        if ($role == 1)
        {
            return view('admin.resident-detail');

        }
        else
        {
            return Redirect::back();
        }


    }
    public function find($lp)
    {

        $role = Auth::user()->role;

        if ($role == 1)
        {


            $checkv = DB::select('select owner from visitor where lp = ?',[$lp]);




            if ($checkv == null)
            {
                $userid = DB::select('select user_id from registered_vehicle where lp = ?',[$lp]);
                $data = json_encode($userid, true);

                $dete = $data[12].$data[13];
                $visitor = DB::select('select * from visitor where owner = ?',[$dete]);
                $profiles = DB::select('select * from users where id = ?',[$dete]);
                $cars = DB::select('select * from registered_vehicle where user_id = ?',[$dete]);
                $visitor = DB::select('select * from visitor where owner = ?',[$dete]);
                $count = count($visitor);
                $count2 = count($cars);
                return view('admin.resident-detail',compact('profiles','cars','count','count2','visitor'));

            }

            else
            {
                $checkv2 = json_encode($checkv, true);
                $dete = $checkv2[10].$checkv2[11];
                $visitor = DB::select('select * from visitor where owner = ?',[$dete]);
                $profiles = DB::select('select * from users where id = ?',[$dete]);
                $cars = DB::select('select * from registered_vehicle where user_id = ?',[$dete]);
                $visitor = DB::select('select * from visitor where owner = ?',[$dete]);
                $count = count($visitor);
                $count2 = count($cars);
                return view('admin.resident-detail',compact('profiles','cars','count','count2','visitor'));


            }





        }
        else
        {
            return Redirect::back();
        }




    }

    //
}
