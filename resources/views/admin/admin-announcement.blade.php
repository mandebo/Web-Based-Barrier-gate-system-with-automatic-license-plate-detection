@extends('admin.dashboard')

@section('admin-announcement')



    <div class="container announcement-create ">
        <div class="pb-2">
            <span class="badge badge-info " style="font-size: 1.2rem;"> Publish announcements</span>

        </div>



        <form action="{{ url('publish-news') }}" method="post" enctype="multipart/form-data" id="publishForm" class="mb-2">
            @csrf

            <div class="form-group">
                <input type="text" name="title" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter title" >
            </div>


            <textarea id="content" name="content"> </textarea>
            <div class="mb-3">
                <input name="image"  class="form-control file-form pr-2" type="file" id="formFile">
{{--                <label for="image" >Choose a file</label>--}}

            </div>

            <button type="button" onclick="showAlert()" class="btn btn-info btn-md">Publish</button>

            <script>
                var desc = CKEDITOR.instances.DSC.getData();
            </script>

        </form>


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
                        title: 'Announcement published',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    document.getElementById('publishForm').submit();

                }
            }

        </script>
        </script>

    </div>





<div class="container pt-5">
    <div class="pb-3">
        <span class="badge badge-info " style="font-size: 1.2rem;"> Latest Announcements</span>
    </div>
    <div class="row">
        @foreach($announcements as $announcement)

            <div class="col-lg-4 ">
                <div class="card mb-4 box-shadow news-box">
                    <img class="card-img-top img-thumbnail border " src="{{asset('/storage/'.$announcement->image)}}" style="height: 8rem;" alt="Card image cap">
                    <div class="card-body" style="height: 150px;">
                        <p class="card-text font-weight-bold">{{$announcement->title}}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group mt-4">
                                <a href="admin_view/{{$announcement->announcement_id}}"><button  type="button" class="btn btn-sm btn-outline-primary">View</button>
                                </a>

                                <a href="edit_announcement/{{$announcement->announcement_id}}"><button type="button" class="btn btn-sm btn-outline-primary">Edit</button>
                                </a>
                                <form action=" {{ url( 'anndelete', $announcement->announcement_id) }}" method="post" id="deleteForm">
                                    @csrf
                                    <a href="anndeletefetch/{{ $announcement->announcement_id }}"><button  type="button"  class="btn btn-sm btn-outline-danger show_confirm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16"><path fill="currentColor" d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/></svg>
                                        </button></a>
                                </form>
                            </div>
                            <small class="text-muted mt-4">{{  Carbon\Carbon::parse($announcement->timestamp)->format('d-m-Y')}}</small>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach
    </div>
</div>

    @isset($deleteinfos)
        @foreach($deleteinfos as $deleteinfo)
            <div>
                <p> {{ $deleteinfo -> title}}</p>
                <p> {{ $deleteinfo -> content}}</p>
            </div>

        @endforeach


    @endisset

    <div class="container" style="height: 300px;">
       <a href="archive"><button class="btn btn-info">Archived</button></a>


    </div>







    <script>
        function showDelete()
        {
            var form =  $(this).closest("#deleteForm");
            var name = $(this).data("name");


            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    {{--window.location.href = 'anndelete/{{ $announcement->announcement_id }}';--}}
                    // document.getElementById('deleteForm').submit();
                    form.submit();




                }

            })

        }
    </script>













@endsection
