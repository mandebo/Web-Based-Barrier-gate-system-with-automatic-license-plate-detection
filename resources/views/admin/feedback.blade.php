@extends('admin.dashboard')

@section('adminfeedback')

    <div class="container border rounded  p-3" style="margin-top: 50px; box-shadow: 2px 2px lightblue;">
        <div class="row">
            <div class="col-lg-1">
                <p> All</p>

            </div>
            <div class="col-lg-1">
                <p> Pending</p>

            </div>
            <div class="col-lg-1">
                <p> Checked</p>

            </div>
        </div>
    </div>

    <div class="container rounded  border" style="margin-top: 40px;box-shadow: 2px 2px lightblue;">
        <table class="table">
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

            @isset($feedbacks)

                @foreach($feedbacks as $feedback)

                    @if($feedback->status == "0")
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $feedback->title }}</td>
                            <td>{{ $feedback->name }}</td>

                            <td>{{  Carbon\Carbon::parse($feedback->timestamp)->format('d-m-Y')}}</td>
                            <td>{{  Carbon\Carbon::parse($feedback->timestamp)->format('h:i:s')}}</td>
                            <td><button type="button" class="btn btn-info" style="font-size: 12px;">Pending</button>
                            </td>
                            <td>
                                <form class="pr-1" action="{{ url('adview',[$feedback->id,$feedback->user_id]) }}" method="get">
                                    @csrf
                                    <button type="submit" class="btn btn-primary" style="font-size: 12px;">view</button>
                                </form>
                            </td>

                        </tr>



                    @else
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $feedback->title }}</td>
                            <td>{{ $feedback->name }}</td>

                            <td>{{  Carbon\Carbon::parse($feedback->timestamp)->format('d-m-Y')}}</td>
                            <td>{{  Carbon\Carbon::parse($feedback->timestamp)->format('h:i:s')}}</td>
                            <td><button type="button" class="btn btn-success" style="font-size: 12px;">Checked</button>
                            </td>
                            <td>
                                <form class="pr-1" action="{{ url('adview',[$feedback->id,$feedback->user_id]) }}" method="get">
                                    @csrf
                                    <button type="submit" class="btn btn-primary" style="font-size: 12px;">view</button>
                                </form>
                            </td>

                        </tr>



                    @endif


                @endforeach

            @endisset


            </tbody>
        </table>

    </div>


@endsection
