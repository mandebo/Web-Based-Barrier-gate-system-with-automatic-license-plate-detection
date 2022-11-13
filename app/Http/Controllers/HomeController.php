<?php

namespace App\Http\Controllers;

use App\Models\RegisteredVehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }

    public function index()
    {
        $role=Auth::user()->role;

        if($role =='1')
        {
            return redirect('monitor');
        }
        else{
            $announcements = DB::select('select * from announcement ORDER BY timestamp DESC LIMIT 6 ');
            return view('resident.announcement-resident')->with('announcements',$announcements);

        }

    }

    public function dash()
    {

       return redirect('redirects');

    }


    public function register()
    {
        $user_id = Auth::user()->id;
        $records = DB::select ('select * from registered_vehicle where user_id = ?', [$user_id]);
        $counter = count(DB::select ('select * from registered_vehicle where user_id =?',[$user_id]));
//        return view('resident.registration')->with('records',$records,'counter',$counter);
        return view('resident.registration', compact('records','counter'));
    }

    public function addlp(Request $request)
    {


        $request -> validate([
            'licenseplate' => 'required',
            'model' => 'required'

        ]);




        $user_id= Auth::user()->id;
        $licenseplate = strtoupper($request->input('licenseplate')); //input is according to name in form
        $check = DB::select('select * from registered_vehicle where lp = ?',[$licenseplate]);

        $model = $request->input('model');
        $timestamp = \Carbon\Carbon::now()->toDateTimeString();

        $data=array('lp'=>$licenseplate,"model"=>$model,"timestamp"=>$timestamp,"user_id"=>$user_id);



        $records = DB::select ('select * from registered_vehicle where user_id = ?', [$user_id]);
        $counter = count(DB::select ('select * from registered_vehicle'));

        if($check == null)
        {
            $query = DB::table('registered_vehicle')->insert($data);
            return redirect('registration')->with( compact('records','counter'))->with('registered','license plate is registered');

        }
        else
        {
            echo("license plate already registered");
            return redirect('registration')->with( compact('records','counter'))->with('duplicate',' there is duplicated license plate');

        }


//        dd($records);
       // return view('resident.registration', compact('records','counter'));

        //redirect is used with compact so that the function wont be called everytime.



    }

    public function editlp(Request $request, $car_id)
    {
//        $newlp = $request -> input('editlp');
//        $newmodel = $request ->input('editmodel');


        $updateDetails = [
            'lp' => $request->input('editlp'),
            'model' => $request->input('editmodel')
        ];

        DB::table('registered_vehicle')
            ->where('car_id', $car_id)
            ->update($updateDetails);

            return redirect('registration');

    }

    public function fetchedit($user_id,$car_id )
    {


        $records = DB::select ('select * from registered_vehicle where user_id = ?', [$user_id]);
        $edits = DB::select('select * from registered_vehicle where car_id = ?',[$car_id]);



        return view('resident.registrationedit',compact('edits','records'));


    }
    public function deletefetch($car_id)
    {

        $user_id = Auth::user()->id;
        $deletes = DB::select('select * from registered_vehicle where car_id=?', [$car_id]);
        $records = DB::select ('select * from registered_vehicle where user_id = ?', [$user_id]);
        $counter = count(DB::select ('select * from registered_vehicle'));

        return view('resident.registration-delete',compact('deletes','records','counter'));

    }



    public function deletelp($car_id)
    {
        DB::delete('delete from registered_vehicle where car_id = ?', [$car_id]);
        return redirect('registration');

    }


}
