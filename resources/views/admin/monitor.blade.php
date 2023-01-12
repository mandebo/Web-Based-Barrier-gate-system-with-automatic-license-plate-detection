@extends('admin.dashboard')

@section('monitor')



    <div class=" container  monitor-table table-responsive-md   p-5" id="refresh">
        <div class="card" id="capture"  style="box-shadow: 1px 1px lightgray;" >
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
                        <td class="text-danger text-center">No Records </td>
                        <td > </td>
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
                                        <td style="color: green;"> PASS</td>
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
                                        <td style="color: green;"> PASS</td>
                                        <td>{{  Carbon\Carbon::parse($bg_record->timestamp)->format('h:i:s')}}</td>
                                        <td>{{  Carbon\Carbon::parse($bg_record->timestamp)->format('d-m-Y')}}</td>
                                        <td style="color: red">OUT</td>
                                        <td><a href="resident-find/{{ $bg_record->lp }}"><button title="find resident" class=" btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><g transform="translate(512 0) scale(-1 1)"><path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128c0-70.7 57.2-128 128-128c70.7 0 128 57.2 128 128c0 70.7-57.2 128-128 128z"/></g></svg></button></a></td>

                                    </tr>
                                @endif


                            @elseif($bg_record -> status == 0)
                                <tr id="">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $bg_record -> lp}}</td>
                                    <td style="color: red;"> FAILED</td>

                                    <td>{{  Carbon\Carbon::parse($bg_record->timestamp)->format('h:i:s')}}</td>
                                    <td>{{  Carbon\Carbon::parse($bg_record->timestamp)->format('d-m-Y')}}</td>
                                    <td style="color: red;">UNREGISTERED</td>
                                    <td><a  style="font-size: 15px;"><button title="unregistered?" class=" btn btn-warning">
                                                <svg style="color: white;" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M20.5 14.5V16H19v-1.5h1.5m-2-5H17V9a3 3 0 0 1 3-3a3 3 0 0 1 3 3c0 .97-.5 1.88-1.29 2.41l-.3.19c-.57.4-.91 1.01-.91 1.7v.2H19v-.2c0-1.19.6-2.3 1.59-2.95l.29-.19c.39-.26.62-.69.62-1.16A1.5 1.5 0 0 0 20 7.5A1.5 1.5 0 0 0 18.5 9v.5M9 13c2.67 0 8 1.34 8 4v3H1v-3c0-2.66 5.33-4 8-4m0-9a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10.9c-2.97 0-6.1 1.46-6.1 2.1v1.1h12.2V17c0-.64-3.13-2.1-6.1-2.1m0-9A2.1 2.1 0 0 0 6.9 8A2.1 2.1 0 0 0 9 10.1A2.1 2.1 0 0 0 11.1 8A2.1 2.1 0 0 0 9 5.9Z"/></svg>                                            </button></a></td>


                            @else
                                <tr id="">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $bg_record -> lp}}</td>
                                    <td style="color: darkred"> BLACKLISTED</td>

                                    <td>{{  Carbon\Carbon::parse($bg_record->timestamp)->format('h:i:s')}}</td>
                                    <td>{{  Carbon\Carbon::parse($bg_record->timestamp)->format('d-m-Y')}}</td>
                                    <td style="color: darkred">BLACKLISTED</td>
                                    <td><a href="blacklist"><button title="black listed!" class=" btn btn-danger">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M22.56 16.3L14.89 3.58a3.43 3.43 0 0 0-5.78 0L1.44 16.3a3 3 0 0 0-.05 3A3.37 3.37 0 0 0 4.33 21h15.34a3.37 3.37 0 0 0 2.94-1.66a3 3 0 0 0-.05-3.04Zm-1.7 2.05a1.31 1.31 0 0 1-1.19.65H4.33a1.31 1.31 0 0 1-1.19-.65a1 1 0 0 1 0-1l7.68-12.73a1.48 1.48 0 0 1 2.36 0l7.67 12.72a1 1 0 0 1 .01 1.01Z"/><circle cx="12" cy="16" r="1" fill="currentColor"/><path fill="currentColor" d="M12 8a1 1 0 0 0-1 1v4a1 1 0 0 0 2 0V9a1 1 0 0 0-1-1Z"/></svg>
                                            </button></a></td>

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
