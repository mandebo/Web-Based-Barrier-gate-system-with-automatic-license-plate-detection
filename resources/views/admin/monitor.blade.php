@extends('admin.dashboard')

@section('monitor')



    <div class=" container  monitor-table table-responsive-md   p-5" id="refresh">
        <div class="card" id="capture" >
            <h5 class="card-header">Vehicle monitoring  <span class="badge badge-primary badge-pill">{{date('d/m/Y')}}</span></h5>
            <div class="card-body">


                <table id="data-table" class="table table-striped border table-responsive-xl" style="width:100%">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>License Plate</th>
                        <th>Status</th>
                        <th>Time</th>
                        <th>Date</th>
                        <th>Car way</th>
                        <th></th>

                    </tr>

                    </thead>
                    <tbody>

                    @if(empty($bg_records))
                        <tbody>
                        <td></td>
                        <td></td>
                        <td > </td>
                        <td class="text-danger text-center">No records </td>
                        <td></td>
                        <td></td>
                        <td></td>

                        </tbody>

                    @else
                        <tbody>
                        @foreach($bg_records as $bg_record)

                            @if($bg_record -> status == 1)

                                @if($bg_record -> carway ==0)
                                    <tr id="">
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $bg_record -> lp}}</td>
                                        <td> PASS</td>
                                        <td>{{  Carbon\Carbon::parse($bg_record->timestamp)->format('h:i:s')}}</td>
                                        <td>{{  Carbon\Carbon::parse($bg_record->timestamp)->format('d-m-Y')}}</td>
                                        <td style="color: forestgreen">IN</td>
                                        <td><a href="resident-find/{{ $bg_record->lp }}"><button title="find resident" class=" btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><g transform="translate(512 0) scale(-1 1)"><path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128c0-70.7 57.2-128 128-128c70.7 0 128 57.2 128 128c0 70.7-57.2 128-128 128z"/></g></svg></button></a></td>
{{--                                        <td><button class="btn btn-primary"></button></td>--}}

                                    </tr>
                                @else
                                    <tr id="">
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $bg_record -> lp}}</td>
                                        <td> PASS</td>
                                        <td>{{  Carbon\Carbon::parse($bg_record->timestamp)->format('h:i:s')}}</td>
                                        <td>{{  Carbon\Carbon::parse($bg_record->timestamp)->format('d-m-Y')}}</td>
                                        <td style="color: red">OUT</td>
                                        <td><a href="resident-find/{{ $bg_record->lp }}"><button title="find resident" class=" btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><g transform="translate(512 0) scale(-1 1)"><path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128c0-70.7 57.2-128 128-128c70.7 0 128 57.2 128 128c0 70.7-57.2 128-128 128z"/></g></svg></button></a></td>

                                    </tr>
                                @endif


                            @else
                                <tr id="">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $bg_record -> lp}}</td>
                                    <td> FAILED</td>

                                    <td>{{  Carbon\Carbon::parse($bg_record->timestamp)->format('h:i:s')}}</td>
                                    <td>{{  Carbon\Carbon::parse($bg_record->timestamp)->format('d-m-Y')}}</td>
                                    <td style="color: darkred">UNREGISTERED</td>
                                    <td style="color: red;"><button class="btn" style="background-color: transparent; "> -</button></td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>

                    @endif
                </table>

            </div>
        </div>



{{--        W3school searchh box--}}


{{--        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">--}}



    </div>

{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('#data-table').DataTable();--}}
{{--        });--}}
{{--    </script>--}}


{{--    Date script--}}
    <script>
        function myFunction() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("data-table");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>








@endsection
