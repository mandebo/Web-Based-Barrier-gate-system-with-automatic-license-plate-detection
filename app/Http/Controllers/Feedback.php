<?php

namespace App\Http\Controllers;

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

    public function check ( $id)
    {

        $status = "1";
        DB::table('feedback')->where(['id' => $id])->update(['status' => $status]);
        return Redirect::back();
    }
    public function respond ( $id, Request $request)
    {
        $respond =$request->input('respond');
        $status = "1";
        $time = \Carbon\Carbon::now()->toDateTimeString();
        DB::table('feedback')->where(['id' => $id])->update(['status' => $status, 'respond'=>$respond, 'respond_time'=>$time]);
        return Redirect::back();
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
            'picture' => 'required'

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

        return redirect('feedback');



    }


    public function admin()
    {
        $feedbacks = DB::select('select * from feedback ORDER BY timestamp DESC');

        return view('admin.feedback')->with('feedbacks',$feedbacks);

    }
    //
}
