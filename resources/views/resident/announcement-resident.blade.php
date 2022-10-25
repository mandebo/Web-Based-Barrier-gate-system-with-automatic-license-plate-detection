@extends('dashboard')

@section('r-announcement')


    <div class="container  p-5" style="margin-top: 70px">
        <span class="badge badge-info" style="font-size: 1.2rem;"> Latest announcements</span>
        <div class="row " style="margin-top: 15px;">
            @foreach($announcements as $announcement)
                <div class="col-lg-4">
                    <div class="card mb-4 box-shadow news-box">
                        <img class="card-img-top img-thumbnail border " src="{{asset('/storage/'.$announcement->image)}}" style="height: 8rem;" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text font-weight-bold">{{$announcement->title}}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">



{{--                                        <button href="view_announcement/{{$announcement->announcement_id}}" type="button" class="btn btn-sm btn-outline-primary">View</button>--}}
{{--                                        <button type="button" class="btn btn-sm btn-outline-primary"> <a href="view_announcement/{{$announcement->announcement_id}}"> View</a></button>--}}
                                        <a href="view_announcement/{{$announcement->announcement_id}}"><button type="button" class="btn btn-sm btn-outline-primary">View</button></a>
{{--                                        <td><a href="deletelp/{{$record->car_id}}"><button type="button" class="btn btn-danger">--}}



                                </div>
                                <small class="text-muted">{{  Carbon\Carbon::parse($announcement->timestamp)->format('d-m-Y')}}</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

@endsection
