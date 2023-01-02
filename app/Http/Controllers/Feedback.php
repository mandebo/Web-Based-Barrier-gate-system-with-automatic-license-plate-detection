<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Feedback extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;



        $feedbacks = DB::select('select * from feedback  where user_id = ? ORDER BY timestamp DESC', [$user_id]);
        return view('resident.feedback')->with('feedbacks',$feedbacks);
    }

   public function residentview($id)
   {


       $feedbacks = DB::select('select * from feedback  where id = ? ORDER BY timestamp DESC', [$id]);

       return view('resident.res-fb',compact('feedbacks'));

   }

   public function deletefb ($id)
   {
       DB::delete('delete from feedback where id = ?',[$id]);
       return Redirect::back();

   }


    public function check ( $id)
    {

        $status = "1";
        DB::table('feedback')->where(['id' => $id])->update(['status' => $status]);
        return Redirect::back()->with('checked','this feedback is marked as checked');
    }
    public function respond ( $id, Request $request)
    {
        $respond =$request->input('respond');
        $status = "1";
        $time = \Carbon\Carbon::now()->toDateTimeString();
        DB::table('feedback')->where(['id' => $id])->update(['status' => $status, 'respond'=>$respond, 'respond_time'=>$time]);
        return Redirect::back()->with('respond','respond added');
    }

    public function adview($id, $user_id)
    {

        $users = DB::select('select * from users where id = ?', [$user_id]);

        $feedbacks = DB::select('select * from feedback  where id = ? ORDER BY timestamp DESC', [$id]);

        return view('admin.fb-view',compact('users','feedbacks'));


//        return view('admin.edit-announcement',compact('ann_edits','announcements'));


    }

    public function add(Request $request)
    {
        $request -> validate([
            'title' => 'required',
            'description' => 'required',


        ]);


        $title = $request ->input('title');
        $content = $request->input('description');
        $picture = $request -> file('picture');


        if ($picture)
        {
            $user_id = Auth::user()->id;
            $status = "0";
            $respond ="";
            $newfile = $request->file('picture');
            $file_path = $newfile->store('images','public');

            $name = Auth::user()->name;



            $timestamp = \Carbon\Carbon::now()->toDateTimeString();
            $data=array('title'=>$title,"content"=>$content,"picture"=>$file_path,"timestamp"=>$timestamp,
            'user_id'=>$user_id, 'status'=>$status, 'respond'=> $respond, 'name'=>$name);

//                dd(asset(asset('/storage/'.$file_path)));
            $query = DB::table('feedback')->insert($data);



//            $announcements = DB::select('select * from announcement ORDER BY timestamp DESC ');
//            return redirect('announcement-admin')->with('announcements',$announcements);

        }
        else
        {
            $user_id = Auth::user()->id;
            $status = "0";
            $respond ="";
            $name = Auth::user()->name;



            $timestamp = \Carbon\Carbon::now()->toDateTimeString();
            $data=array('title'=>$title,"content"=>$content,"timestamp"=>$timestamp,
                'user_id'=>$user_id, 'status'=>$status, 'respond'=> $respond, 'name'=>$name);

            $query = DB::table('feedback')->insert($data);
        }

        return redirect('feedback')->with('feedbacksuccess','license plate is registered');





    }


    public function admin()
    {

        $zero = "0";
        $one = "1";
        $feedbacks = DB::select('select * from feedback ORDER BY timestamp DESC');
        $pending = DB::select('select * from feedback where status = ? ORDER BY timestamp DESC ',[$zero]);

        $checked = DB::select('select * from feedback where status = ? ORDER BY timestamp DESC ',[$one]);
        $countpend = count($pending);



        return view('admin.feedback',compact('feedbacks','pending','countpend'));

    }
    public  function pendpage()
    {
        $zero = "0";
        $pending = DB::select('select * from feedback where status = ? ORDER BY timestamp DESC ',[$zero]);

        $countpend = count($pending);

        return view('admin.pending',compact('pending','countpend'));

    }
    public  function checkpage()
    {
        $one = "1";
        $zero = "0";
        $checked = DB::select('select * from feedback where status = ? ORDER BY timestamp DESC ',[$one]);
        $pending = DB::select('select * from feedback where status = ? ORDER BY timestamp DESC ',[$zero]);
        $countpend = count($pending);
        return view('admin.checked', compact('checked','countpend'));

    }

    public function fbdelete($id)
    {

        $user_id = Auth::user()->id;
        $deletes = DB::select('select * from feedback where id = ?',[$id]);
        $feedbacks = DB::select('select * from feedback  where user_id = ? ORDER BY timestamp DESC', [$user_id]);

        return view('resident.feedback-delete',compact('deletes','feedbacks'));




    }

    public function fbgone($id)
    {

        DB::delete('delete from feedback where id = ?', [$id]);

        return redirect('feedback')->with('deleted','feedbacks deleted successfully');



    }


    //
}
