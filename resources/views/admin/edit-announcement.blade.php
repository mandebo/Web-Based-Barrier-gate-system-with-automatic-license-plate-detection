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
            <span class="badge badge-info " style="font-size: 1.2rem;"> Edit announcements</span>

        </div>



        @foreach($ann_edits as $ann_edit)
            <form action="{{ url('save_annedit',$ann_edit->announcement_id) }}" method="post" enctype="multipart/form-data" id="editForm" class="mb-2">
                @csrf

                <div class="form-group">
                    <input autofocus type="text" name="title" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter title"  value="{{$ann_edit->title}}">
                </div>


                <textarea id="content" name="content" >{{$ann_edit->content}} </textarea>
                <div class="mb-3">
                    <input name="image" class="form-control file-form pr-2" type="file" id="formFile">
                </div>

                <button type="button" onclick="showAlert()" class="btn btn-info btn-md">Save</button>

                <script>
                    var desc = CKEDITOR.instances.DSC.getData();
                </script>

            </form>

        @endforeach




        <script>
            CKEDITOR.replace('content')
        </script>

        <script>
            function showAlert()
            {
                var title = document.getElementById("title").value;
                var content = document.getElementById("content").value;
                var file = document.getElementById("formFile").value;

                event.preventDefault();


                if(title == '' || content == ''|| file == '' )
                {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Please input all fields'

                    })
                }

                else
                {
                    Swal.fire({

                        icon: 'success',
                        title: 'Record updated',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    document.getElementById('editForm').submit();

                }
            }

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
                        <div class="card-body" style="height: 150px;">
                            <p class="card-text">{{$announcement->title}}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="view_announcement/{{$announcement->announcement_id}}"><button  type="button" class="btn btn-sm btn-outline-primary">View</button>
                                    </a>

                                    <a href="edit_announcement/{{$announcement->announcement_id}}"><button type="button" class="btn btn-sm btn-outline-primary">Edit</button>
                                    </a>
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
