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
            return view('admin.dashboard');
        }
        else{
            $announcements = DB::select('select * from announcement ORDER BY timestamp DESC ');
            return view('resident.announcement-resident')->with('announcements',$announcements);

        }

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
        $model = $request->input('model');
        $timestamp = \Carbon\Carbon::now()->toDateTimeString();

        $data=array('lp'=>$licenseplate,"model"=>$model,"timestamp"=>$timestamp,"user_id"=>$user_id);


        $query = DB::table('registered_vehicle')->insert($data);
        $records = DB::select ('select * from registered_vehicle where user_id = ?', [$user_id]);
        $counter = count(DB::select ('select * from registered_vehicle'));
//        dd($records);
       // return view('resident.registration', compact('records','counter'));
        return redirect('registration')->with( compact('records','counter'));

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

            return redirect('registration')->with('updated');

    }


    public function deletelp($car_id)
    {
        DB::delete('delete from registered_vehicle where car_id = ?', [$car_id]);
        return redirect('registration')->with('deleted','Record is deleted successfully');

    }


}
