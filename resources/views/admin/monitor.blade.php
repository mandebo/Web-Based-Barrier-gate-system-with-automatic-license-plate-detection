@extends('admin.dashboard')

@section('monitor')



    <div class=" container  monitor-table table-responsive-md   p-5" id="refresh">
        <div class="card">
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

                    </tr>

                    </thead>
                    <tbody>

                    @if(empty($bg_records))
                        <tbody>
                        <td></td>
                        <td></td>
                        <td class="text-danger text-center"> No records </td>
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
                                    </tr>
                                @else
                                    <tr id="">
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $bg_record -> lp}}</td>
                                        <td> PASS</td>
                                        <td>{{  Carbon\Carbon::parse($bg_record->timestamp)->format('h:i:s')}}</td>
                                        <td>{{  Carbon\Carbon::parse($bg_record->timestamp)->format('d-m-Y')}}</td>
                                        <td style="color: red">OUT</td>
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
