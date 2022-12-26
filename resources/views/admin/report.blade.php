@extends('admin.dashboard')

@section('report')

    <div class="container  report border p-3 bg-light ">

        <form action="{{ url('dateprocess') }}" method="post">
            @csrf
            <div class=" row text-center date-picker " >
                <h4 class="date-picker col-sm-2 col-md-2 col-lg-2">Date:</h4>
                <input class="col-sm-5 col-md-5 col-lg-5" id="datefield" type="date" min="2022-01-01"    name="datepick" style="outline: blue">
                <div class="col-sm-2">
                    <button class="btn btn-primary" type="submit"> Generate</button>
                </div>
            </div>
        </form>
    </div>

    <div class="container border p-5 " id="capture">

        @if(empty($report_records))
            <h5 class="text-center" style="color: blue">Please choose a date</h5>

        @else
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
                                <span class="badge badge-primary badge-pill">{{$date}}</span>
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
                    <table id="data-table2" class="report-table table table-striped border  table-responsive-xl" id="capture" style="width:100%; ">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>License Plate</th>
                            <th>Status</th>
                            <th>Timestamp</th>
                            <th>Date</th>
                            <th></th>
                            <th></th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($report_records as $report_record)

                            @if($report_record -> status == 1)
                                @if($report_record -> carway ==0)
                                    <tr id="">
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $report_record -> lp}}</td>
                                        <td style="color: green;"> PASS</td>
                                        <td>{{  Carbon\Carbon::parse($report_record->timestamp)->format('h:i:s')}}</td>
                                        <td>{{  Carbon\Carbon::parse($report_record->timestamp)->format('d-m-Y')}}</td>
                                        <td style="color: forestgreen">IN</td>
                                        <td><a href="resident-find/{{ $report_record->lp }}"><button title="find resident" class=" btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><g transform="translate(512 0) scale(-1 1)"><path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128c0-70.7 57.2-128 128-128c70.7 0 128 57.2 128 128c0 70.7-57.2 128-128 128z"/></g></svg></button></a></td>
                                        {{--                                        <td><button class="btn btn-primary"></button></td>--}}

                                    </tr>
                                @else
                                    <tr id="">
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $report_record -> lp}}</td>
                                        <td style="color: green;"> PASS</td>
                                        <td>{{  Carbon\Carbon::parse($report_record->timestamp)->format('h:i:s')}}</td>
                                        <td>{{  Carbon\Carbon::parse($report_record->timestamp)->format('d-m-Y')}}</td>
                                        <td style="color: red">OUT</td>
                                        <td><a href="resident-find/{{ $report_record->lp }}"><button title="find resident" class=" btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><g transform="translate(512 0) scale(-1 1)"><path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128c0-70.7 57.2-128 128-128c70.7 0 128 57.2 128 128c0 70.7-57.2 128-128 128z"/></g></svg></button></a></td>

                                    </tr>
                                @endif


                            @else
                                <tr id="">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $report_record -> lp}}</td>
                                    <td> FAILED</td>

                                    <td>{{  Carbon\Carbon::parse($report_record->timestamp)->format('h:i:s')}}</td>
                                    <td>{{  Carbon\Carbon::parse($report_record->timestamp)->format('d-m-Y')}}</td>
                                    <td style="color: darkred">UNREGISTERED</td>
                                    <td style="color: red;"><button class="btn" style="background-color: transparent; "> -</button></td>
                                </tr>

                            @endif

                        @endforeach


                        </tbody>
                    </table>

{{--                        <form action="{{ url('printpdf', $report_record->timestamp) }}" method="post">--}}


                        <button onclick="htmlcanvas()" type="button" class=" print-btn btn btn-primary btn-sm">Save report</button>

                </div>
{{--                <script>--}}

{{--                    function screenShot()--}}
{{--                    {--}}
{{--                        import html2canvas from 'html2canvas';--}}
{{--                        html2canvas("#data-table2").then(function(canvas) {--}}
{{--                            document.body.appendChild(canvas);--}}
{{--                        });--}}

{{--                    }--}}

{{--                </script>--}}


            @endisset

        @endif





    </div>




    <div>

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

{{--    <script>--}}
{{--        function htmlcanvas()--}}
{{--        {--}}
{{--            var pdf = new jsPDF();--}}

{{--// Select the div that you want to convert to PDF--}}
{{--            var div = document.querySelector('#capture');--}}

{{--// Use the html method to add the contents of the div to the PDF--}}

{{--            --}}
{{--            pdf.fromHtml(div, {--}}
{{--                // Set the x and y coordinates where the div should be placed on the PDF--}}
{{--                x: 10,--}}
{{--                y: 10--}}
{{--            });--}}

{{--// Save the PDF--}}
{{--            pdf.save('my-pdf.pdf');--}}


{{--        }--}}

{{--    </script>--}}


    <script>
        function htmlcanvas()
        {
            html2canvas(document.querySelector('#capture')).then(function(canvas) {
                saveAs(canvas.toDataURL(), 'Access report {{ date('d-m-Y') }}.png');
            });

        }
    </script>

    <script>
        function saveAs(uri, filename) {

            var link = document.createElement('a');

            if (typeof link.download === 'string') {

                link.href = uri;
                link.download = filename;

                //Firefox requires the link to be in the body
                document.body.appendChild(link);

                //simulate click
                link.click();

                //remove the link when done
                document.body.removeChild(link);

            } else {

                window.open(uri);

            }
        }
    </script>








@endsection
