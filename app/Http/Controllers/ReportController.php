<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Barriergate;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use App\Models\RegisteredVehicle;

class ReportController extends Controller
{
    public function printpdf( $report_records)
    {
//        dd($report_records);


//
//        $report_records = DB::select('select * from barriergate where DATE(timestamp) = ?',[$date]);
//        $count_records = count(DB::select('select * from barriergate where DATE(timestamp) = ?',[$date]));
//        $pass = count(DB::select('select * from barriergate where status = 1 and date(timestamp) =?',[$date]));
//        $fail = count(DB::select('select * from barriergate where status = 0 and date(timestamp) =?',[$date]));
//
//        $data = [$report_records, $count_records, $pass,$fail];
//        $pdf = Pdf::loadView('admin.report', $data);
//        return $pdf->download();






    }

    public function index()
    {
        return view('admin.report');

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
