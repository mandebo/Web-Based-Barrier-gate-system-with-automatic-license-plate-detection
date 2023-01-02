@extends('admin.dashboard')

@section('pending')
    <div class="container border rounded  p-3" style="margin-top: 50px; box-shadow: 2px 2px lightblue;">
        <div class="row">
            <div class="col-lg-1">
                <a href="admin-feedback" style="color: gray;">All</a>

            </div>
            <div class="col-lg-1">
                @if($countpend > 0)
                    <a  href="pending" class="notification">Pending

                        <span class="badge">

                        {{ $countpend }}
                        </span></a>

                @else
                    <a href="pending" >Pending

                    </a>

                @endif

            </div>
            <div class="col-lg-1">
                <a href="checking" style="color: gray;">Checked</a>

            </div>
        </div>
    </div>



    <div class="container rounded p-3  border" style="margin-top: 20px;box-shadow: 2px 2px lightblue;">
        <table class="table" id="data-table2">
            <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Time</th>
                <th scope="col">Date</th>
                <th scope="col">Status</th>
                <th scope="col"></th>


            </tr>
            </thead>
            <tbody>

            @if($countpend > 0)
                @isset($pending)

                    @foreach($pending as $pend)

                        @if($pend->status == "0")
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $pend->title }}</td>
                                <td>{{ $pend->name }}</td>

                                <td>{{  Carbon\Carbon::parse($pend->timestamp)->format('d-m-Y')}}</td>
                                <td>{{  Carbon\Carbon::parse($pend->timestamp)->format('h:i:s')}}</td>
                                <td><button type="button" class="btn btn-info" style="font-size: 12px;">Pending</button>
                                </td>
                                <td>
                                    <form class="pr-1" action="{{ url('adview',[$pend->id,$pend->user_id]) }}" method="get">
                                        @csrf
                                        <button type="submit" class="btn btn-primary" style="font-size: 12px;">view</button>
                                    </form>
                                </td>

                            </tr>



                        @else
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $pend->title }}</td>
                                <td>{{ $pend->name }}</td>

                                <td>{{  Carbon\Carbon::parse($pend->timestamp)->format('d-m-Y')}}</td>
                                <td>{{  Carbon\Carbon::parse($pend->timestamp)->format('h:i:s')}}</td>
                                <td><button type="button" class="btn btn-success" style="font-size: 12px;">Checked</button>
                                </td>
                                <td>
                                    <form class="pr-1" action="{{ url('adview',[$pend->id,$feedback->user_id]) }}" method="get">
                                        @csrf
                                        <button type="submit" class="btn btn-primary" style="font-size: 12px;">view</button>
                                    </form>
                                </td>

                            </tr>



                        @endif


                    @endforeach

                @endisset


            </tbody>


            @else
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td></td>

                    <td style="color: red;">No pending feedbacks</td>
                    <td></td>
                    <td></button>
                    </td>
                    <td>

                    </td>

                </tr>





            @endif


        </table>

    </div>




@endsection
