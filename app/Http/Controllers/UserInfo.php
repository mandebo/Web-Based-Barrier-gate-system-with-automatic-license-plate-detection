<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserInfo extends Controller
{
    public function index()
    {


        $lps = DB::select('select id,name, COUNT(lp) from registered_vehicle INNER JOIN users ON registered_vehicle.user_id
        = users.id GROUP BY id,name' );

        $records = DB::select('select * from users where role = ?',[0]);



        return view('admin.resident_info')->with('records',$records);
    }

    public function profile($id)
    {
        $profiles = DB::select('select * from users where id = ?',[$id]);
        $cars = DB::select('select * from registered_vehicle where user_id = ?',[$id]);
        return view('admin.resident-detail',compact('profiles','cars'));
    }
    public function details()
    {
        return view('admin.resident-detail');
    }
    public function find($lp)
    {

        $userid = DB::select('select user_id from registered_vehicle where lp = ?',[$lp]);
//        $data= $userid[0]['user_id'];
        $data = json_encode($userid, true);

        $dete = $data[12];







        $profiles = DB::select('select * from users where id = ?',[$dete]);
        $cars = DB::select('select * from registered_vehicle where user_id = ?',[$dete]);
        return view('admin.resident-detail',compact('profiles','cars'));

    }

    //
}
