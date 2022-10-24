@extends('admin.dashboard')

@section('admin-announcement')


    <div class="container announcement-create ">

        <form action="{{url('publis-news')}}" method="post">
            <div class="form-group">
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter title">

            </div>

            <div id="editor"> </div>
            <div class="mb-3">
                <input class="form-control file-form pr-2" type="file" id="formFile">
            </div>

            <button type="submit" class="btn btn-primary btn-md">Publish</button>


        </form>


        <script>
            CKEDITOR.replace('editor')
        </script>

    </div>








@endsection
