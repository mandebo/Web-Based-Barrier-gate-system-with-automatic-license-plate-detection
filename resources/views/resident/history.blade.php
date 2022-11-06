@extends('dashboard')


@section('history')

    <div class="container bg-info p-3 " style="margin-top: 100px;">
        <h4 style="color: white"> User Access History</h4>


    </div>
    <div class="container bg-light p-5 border " >
        <h5 class=" text-wrap pb-2" style="color: darkblue; text-decoration: underline"> Resident details</h5>

        @foreach( $records as $record)
            <div class="row border-bottom">
                <div class="col-lg-6">
                    Resident name:
                </div>
                <div class="col-lg-6">
                        {{ $record->name }}
                </div>
            </div>
            <div class="row pt-1">
                <div class="col-lg-6">
                   Room no:
                </div>
                <div class="col-lg-6">
                    {{ $record->room_no }}
                </div>

            </div>

        @endforeach


        <div class="row pt-1 pb-5">

            <div class="col-lg-6">
                License Plate :
            </div>
            <div class="col-lg-6">
                <form action=" {{ url('gethistory') }}" method="post">
                    @csrf
                    <select class=" droppy rounded bg-info border-none " name="cars" id="cars" style="color: white;padding: 2.8px; " >
                        <option value="none" selected disabled hidden>Choose Vehicle</option>

                        @foreach( $cars as $car)

                            <option  value="{{ $car->lp }}">{{ $car->lp }}</option>
                        @endforeach

                    </select>

                    <button type="submit" class="btn btn-sm btn-primary"> submit</button>

                </form>
            </div>

        </div>

        @isset($history)
            @if(empty($history))

                <table class="table table-striped mt-5 border " >
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
                            <tr id="">
                                <th scope="row"></th>
                                <td></td>
                                <td style="padding-left: 30px;color: red"> No Records Available</td>
                                <td></td>
                                <td></td>
                                <td style="color: forestgreen"></td>
                            </tr>
                    </tbody>


                </table>

            @else

                <table class="table table-striped mt-5 border paging_full_numbers " id="history-table" >
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>License Plate</th>
{{--                        <th>Status</th>--}}
                        <th>Time</th>
                        <th>Date</th>
                        <th>Car way</th>

                    </tr>
                    </thead>

                    <tbody>
                    @foreach($history as $his)
                        @if($his -> carway ==0)
                            <tr id="">
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $his -> lp}}</td>
{{--                                <td> PASS</td>--}}
                                <td>{{  Carbon\Carbon::parse($his->timestamp)->format('h:i:s')}}</td>
                                <td>{{  Carbon\Carbon::parse($his->timestamp)->format('d-m-Y')}}</td>
                                <td style="color: forestgreen">IN</td>
                            </tr>
                        @else
                            <tr id="">
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $his -> lp}}</td>
{{--                                <td> PASS</td>--}}
                                <td>{{  Carbon\Carbon::parse($his->timestamp)->format('h:i:s')}}</td>
                                <td>{{  Carbon\Carbon::parse($his->timestamp)->format('d-m-Y')}}</td>
                                <td style="color: red">OUT</td>
                            </tr>
                        @endif


                    @endforeach


                    </tbody>


                </table>
            @endif



    </div>

        @endisset
    <script>
        $(document).ready(function () {
            $('#history-table').DataTable({

            });
        });


    </script>








@endsection
