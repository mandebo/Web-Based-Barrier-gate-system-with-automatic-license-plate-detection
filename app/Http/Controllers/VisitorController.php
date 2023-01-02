<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class VisitorController extends Controller
{

    public function index()
    {

        $visitors = DB::select('select * from visitor ORDER BY datefrom DESC ');

        return view('admin.visitor')->with('visitors',$visitors);
    }

    public function addv(Request $request)
    {

        $lp = $request->input('lp');


        $phone = $request->input('phone');
        $room = $request->input('room');
        $from = $request->input('dateFrom');
        $to = $request->input('dateTo');

        $owner = DB::select('select id from users where room_no = ?', [$room]);

        $duplicate = DB::select('select * from visitor where lp = ?', [$lp]);



        if($duplicate == null)
        {
            if ($owner == null)
            {
                return Redirect::back()->with('not_exist',' Owner does not exist');
            }
            else
            {
                $owner2 = json_encode($owner, true);

                $resident = $owner2[7].$owner2[8];

                $data=array('lp'=>$lp,"phone"=>$phone,"room"=>$room,"datefrom"=>$from, 'dateto'=>$to, 'owner'=> $resident);
                $query = DB::table('visitor')->insert($data);
                return Redirect::back()->with('success','successfully added visitor');

            }



        }
        else
        {
            return  Redirect::back()->with('duplicated','Visitor is already active');

        }








    }

    //
}
