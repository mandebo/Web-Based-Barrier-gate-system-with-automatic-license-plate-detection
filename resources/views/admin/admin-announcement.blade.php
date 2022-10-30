@extends('admin.dashboard')

@section('admin-announcement')


{{--        <div class="container row m-lg-3 announcement-view">--}}
{{--            @foreach($announcements as $announcement)--}}
{{--                <div class="card col-lg-4" style="width: 18rem;">--}}
{{--                    <img class="card-img-top" src="{{asset('/storage/'.$announcement->image)}}" alt="Card image cap">--}}
{{--                    <div class="card-body">--}}
{{--                        <h5 class="card-title"> {{$announcement->title}}</h5>--}}
{{--                        <a href="#" class="btn btn-primary">Go somewhere</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}






    <div class="container announcement-create ">
        <div class="pb-2">
            <span class="badge badge-info " style="font-size: 1.2rem;"> Publish announcements</span>

        </div>

        @if(Session::get('publish'))
            <div class="alert alert-success container">
                Announcement is published successfully
            </div>

        @endif

        <form action="{{ url('publish-news') }}" method="post" enctype="multipart/form-data" class="mb-2">
            @csrf

            <div class="form-group">
                <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter title" >
            </div>


            <textarea id="content" name="content"> </textarea>
            <div class="mb-3">
                <input name="image" class="form-control file-form pr-2" type="file" id="formFile">
            </div>

            <button type="submit" class="btn btn-info btn-md">Publish</button>

            <script>
                var desc = CKEDITOR.instances.DSC.getData();
            </script>

        </form>


        <script>
            CKEDITOR.replace('content')
        </script>

    </div>





<div class="container pt-5">
    <div class="pb-3">
        <span class="badge badge-info " style="font-size: 1.2rem;"> Past announcements</span>
    </div>
    <div class="row">
        @foreach($announcements as $announcement)
            <div class="col-lg-4 ">
                <div class="card mb-4 box-shadow news-box">
                    <img class="card-img-top img-thumbnail border " src="{{asset('/storage/'.$announcement->image)}}" style="height: 8rem;" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text">{{$announcement->title}}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-primary">View</button>
                                <button type="button" class="btn btn-sm btn-outline-primary">Edit</button>
                            </div>
                            <small class="text-muted">{{  Carbon\Carbon::parse($announcement->timestamp)->format('d-m-Y')}}</small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>











@endsection
