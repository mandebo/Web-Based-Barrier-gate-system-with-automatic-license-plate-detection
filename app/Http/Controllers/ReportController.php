<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Barriergate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use App\Models\RegisteredVehicle;
use Illuminate\Support\Facades\Redirect;
use Spatie\Browsershot\Browsershot;


class ReportController extends Controller
{
    public function printpdf( $report_records)
    {
         $date = Carbon::parse($report_records)->format('Y-m-d');
         $report_records = DB::select('select * from barriergate where DATE(timestamp) = ?',[$date]);
        $count_records = count($report_records);

        $pass = count(DB::select('select * from barriergate where status = 1 and date(timestamp) =?',[$date]));
        $fail = count(DB::select('select * from barriergate where status = 0 and date(timestamp) =?',[$date]));

        $data = [
            $report_records,
            $pass,
            $fail,
            $count_records,
        ];


      $pdf =  Pdf::loadView('admin.report', compact('report_records'));
      return $pdf->download('sample.pdf');








//        $count_records = count($report_records);
//        $pass = count(DB::select('select * from barriergate where status = 1 and date(timestamp) =?',[$date]));
//        $fail = count(DB::select('select * from barriergate where status = 0 and date(timestamp) =?',[$date]));
//
//
//
//
//      $dompdf = new Dompdf();
//      $dompdf->loadHtml(view('admin.report'));
//
//      $dompdf->setPaper('A4','landscape');
//      $dompdf->render();
//
//      $dompdf->stream('access_report.pdf',['Attachment'=>false]);
////        return view('admin.report', compact('report_records','pass','fail','count_records'));



//
//        $report_records = DB::select('select * from barriergate where DATE(timestamp) = ?',[$date]);
//        $count_records = count(DB::select('select * from barriergate where DATE(timestamp) = ?',[$date]));
//        $pass = count(DB::select('select * from barriergate where status = 1 and date(timestamp) =?',[$date]));
//        $fail = count(DB::select('select * from barriergate where status = 0 and date(timestamp) =?',[$date]));
//
//        $data = [$report_records, $count_records, $pass,$fail];
//
//        return $pdf->download();






    }

    public function index()
    {
        $role = Auth::user()->role;

        if($role == 1)
        {
            return view('admin.report');

        }
        else
        {
            return Redirect::back();
        }


    }

    public function dateprocess (Request $request)
    {
       // $records = DB::select ('select * from registered_vehicle where user_id = ?', [$user_id]);

        $date= $request->datepick;
        $today = date('Y-m-d');

        $report_records = DB::select('select * from barriergate where DATE(timestamp) = ?',[$date]);
        $count_records = count(DB::select('select * from barriergate where DATE(timestamp) = ?',[$date]));
        $pass = count(DB::select('select * from barriergate where status = 1 and date(timestamp) =?',[$date]));
        $fail = count(DB::select('select * from barriergate where status = 0 and date(timestamp) =?',[$date]));
//        $count_pass = count(DB::select('select * from barriergate where DATE(timestamp) = ? AND status = ?',[$date] ,);)



        return view('admin.report', compact('report_records','pass','fail','count_records'));


    }
    //
}
