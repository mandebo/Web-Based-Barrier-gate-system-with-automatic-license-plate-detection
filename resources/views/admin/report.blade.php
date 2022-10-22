@extends('admin.dashboard')

@section('report')

    <div class="container  report border p-5 bg-light ">

        <form action="{{ url('dateprocess') }}" method="post">
            @csrf
            <div class=" row text-center date-picker " >
                <h4 class="date-picker col-sm-2 col-md-2 col-lg-2">Date:</h4>
                <input class="col-sm-5 col-md-5 col-lg-5" id="datefield" type="date" min="2022-01-01"   name="datepick">
                <div class="col-sm-2">
                    <button class="btn btn-primary" type="submit"> Generate</button>
                </div>
            </div>
        </form>
    </div>

    <div class="container border p-5 ">

        @isset($report_records)

{{--            <h1> The total number of passes is {{$pass}}</h1>--}}
{{--            <h1> The total number of fails is {{$fail}}</h1>--}}

        <div class="container-xl row border">
            <nav class="navbar navbar-light bg-light pb-2">
                <span class="navbar-brand mb-0 h1">Access report chart</span>
            </nav>

            <div class="container col-lg-6 col-md-6 col-sm-6 col-6 border">
                <div class="container col-lg-6">
                    <div id="donut-chart"></div>
                    <script>
                        var chart = bb.generate({
                            data: {
                                columns: [
                                    ["pass", {{$pass}}],
                                    ["fail", {{$fail}}],

                                ],
                                type: "donut",
                                onclick: function (d, i) {
                                    console.log("onclick", d, i);
                                },
                                onover: function (d, i) {
                                    console.log("onover", d, i);
                                },
                                onout: function (d, i) {
                                    console.log("onout", d, i);
                                },
                            },
                            donut: {
                                title: " Report Chart",
                            },
                            bindto: "#donut-chart",
                        });
                    </script>
                </div>
            </div>
            <div class="container col-lg-6 col-md-6 col-sm-6 col-6 border">
                <ul class="list-group mt-5">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Date:
                        <span class="badge badge-primary badge-pill">{{date('d/m/Y')}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Total vehicle detected:
                        <span class="badge badge-primary badge-pill">{{$count_records}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Total vehicle passed:
                        <span class="badge badge-primary badge-pill">{{$pass}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Total vehicle failed:
                        <span class="badge badge-primary badge-pill">{{$fail}}</span>
                    </li>
                </ul>
            </div>



        </div>
            <nav class="navbar navbar-light bg-light report-table border pb-2">
                <span class="navbar-brand mb-0 h1">Access report list</span>
            </nav>



        <div class="container-lg">
            <table id="data-table2" class="report-table table table-striped border  table-responsive-xl" style="width:100%">
                <thead>
                <tr>
                    <th>No</th>
                    <th>License Plate</th>
                    <th>Status</th>
                    <th>Timestamp</th>
                    <th>Date</th>

                </tr>
                </thead>
                <tbody>
                @foreach($report_records as $report_record)

                    @if($report_record -> status == 1)
                        <tr id="">
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $report_record -> lp}}</td>
                            <td class="pass"> PASS</td>
                            <td>{{  Carbon\Carbon::parse($report_record->timestamp)->format('h:i:s')}}</td>
                            <td>{{  Carbon\Carbon::parse($report_record->timestamp)->format('d-m-Y')}}</td>
                        </tr>

                    @else
                        <tr id="">
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $report_record -> lp}}</td>
                            <td class="failed"> FAILED</td>

                            <td>{{  Carbon\Carbon::parse($report_record->timestamp)->format('h:i:s')}}</td>
                            <td>{{  Carbon\Carbon::parse($report_record->timestamp)->format('d-m-Y')}}</td>
                        </tr>

                    @endif

                @endforeach


                </tbody>
            </table>
            <form action="{{ url('printpdf') }}" method="post">
                @csrf
                <button type="submit" class=" print-btn btn btn-primary btn-sm">Print report</button>
            </form>


        </div>


        @endisset



    </div>

    <script>
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!
        var yyyy = today.getFullYear();

        if (dd < 10) {
            dd = '0' + dd;
        }

        if (mm < 10) {
            mm = '0' + mm;
        }

        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById("datefield").setAttribute("max", today);
    </script>




@endsection
