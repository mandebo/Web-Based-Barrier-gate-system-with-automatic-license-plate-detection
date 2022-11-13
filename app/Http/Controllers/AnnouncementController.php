<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnnouncementController extends Controller
{
    public function index()
    {

        $announcements = DB::select('select * from announcement ORDER BY timestamp DESC LIMIT 3 ');
        return view('admin.admin-announcement')->with('announcements',$announcements);
    }
    public function res_index()
    {
        $announcements = DB::select('select * from announcement ORDER BY timestamp DESC LIMIT 6 ');
        return view('resident.announcement-resident')->with('announcements',$announcements);

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
                return redirect('announcement-admin')->with('announcements',$announcements);

            }

    }

    public function view_announcement($announcement_id)
    {
        $annviews = DB::select('select * from announcement where announcement_id = ?',[$announcement_id]);
//        dd($annviews);

        return view('resident.view_announcement')->with('annviews',$annviews);

    }

    public function adminview($announcement_id)
    {

        $annviews = DB::select('select * from announcement where announcement_id = ?',[$announcement_id]);
        return view('admin.adminview')->with('annviews',$annviews);

    }


    public function edit_announcement($announcement_id)
    {
        $ann_edits = DB::select('select * from announcement where announcement_id = ?',[$announcement_id]);
        $announcements = DB::select('select * from announcement ORDER BY timestamp DESC ');
        return view('admin.edit-announcement',compact('ann_edits','announcements'));

    }

    public function save_news( Request $request, $announcement_id)
    {
        $newfile = $request->file('image');
        $file_path = $newfile->store('images','public');


        $updateDetails = [
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'image' => $file_path
        ];

        DB::table('announcement')
            ->where('announcement_id', $announcement_id)
            ->update($updateDetails);


        return redirect('announcement-admin');

    }
    public function deleteannfetch($announcement_id)
    {


        $deleteinfos=DB::select('select * from announcement where announcement_id = ?',[$announcement_id]);
        $announcements = DB::select('select * from announcement ORDER BY timestamp DESC ');

        return view('admin.delete-announcement',compact('deleteinfos','announcements'));


    }


    public function deleteann($announcement_id)
    {

        DB::delete('delete from announcement where announcement_id = ?',[$announcement_id]);
        return redirect('announcement-admin');
    }






}
