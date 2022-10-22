<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Barriergate;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;

class ReportController extends Controller
{
    public function printpdf()
    {
        // instantiate and use the dompdf class
        $data['name']="name";

        $dompdf = new Dompdf();
        require_once "dompdf_config.inc.php";
        $file="http://localhost:8000/dateprocess";
        $html=file_get_contents($file);

        $dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
        $dompdf->render();

// Output the generated PDF to Browser
        $dompdf->stream('report.pdf');



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
