<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnnouncementController extends Controller
{
    public function index()
    {

        $announcements = DB::select('select * from announcement ORDER BY timestamp DESC ');
        return view('admin.admin-announcement')->with('announcements',$announcements);
    }

    public function addnews(Request $request)
    {
        $request -> validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required'

        ]);

        $content = $request->input('content');
        $title = $request ->input('title');
        $image = $request -> file('image');


            if ($image)
            {
                $newfile = $request->file('image');
                $file_path = $newfile->store('images','public');
                $timestamp = \Carbon\Carbon::now()->toDateTimeString();
                $data=array('title'=>$title,"content"=>$content,"image"=>$file_path,"timestamp"=>$timestamp);

//                dd(asset(asset('/storage/'.$file_path)));
                $query = DB::table('announcement')->insert($data);

                $announcements = DB::select('select * from announcement ORDER BY timestamp DESC ');
//               return view('admin.admin-announcement')->with('announcements',$announcements);



            }

    }


}
