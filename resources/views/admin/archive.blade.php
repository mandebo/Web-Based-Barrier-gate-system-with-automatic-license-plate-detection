@extends('admin.dashboard')

@section('archive')

    <div class="container">
        <div class="mt-5 ">
            <span class="badge badge-info " style="font-size: 1.2rem;"> Archived Announcements</span>

            <div class="pt-4 ">
                <table class="table border mt-4" id="archive">
                    <thead class="thead-light ">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Title</th>
                        <th scope="col">Date Published</th>
                        <th scope="col">Thumbnail</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($announcements as $an)
                        <tr>
                            <td>{{ $loop->iteration }} </td>
                            <td class="font-medium">{{ $an -> title }}</td>
                            <td>{{  Carbon\Carbon::parse($an->timestamp)->format('d-m-Y')}}</td>
                            <td>  <img class="card-img-top img-thumbnail border " src="{{asset('/storage/'.$an->image)}}" style="height: 3.5rem;" alt="Card image cap">

                            </td>
                            <td>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group mt-4">
                                        <a href="admin_view/{{$an->announcement_id}}"><button  type="button" class="btn btn-sm btn-outline-primary">View</button>
                                        </a>

                                        <a href="edit_announcement/{{$an->announcement_id}}"><button type="button" class="btn btn-sm btn-outline-primary">Edit</button>
                                        </a>
                                        <form action=" {{ url( 'anndelete', $an->announcement_id) }}" method="post" id="deleteForm">
                                            @csrf
                                            <a href="anndeletefetch/{{ $an->announcement_id }}"><button  type="button"  class="btn btn-sm btn-outline-danger show_confirm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16"><path fill="currentColor" d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/></svg>
                                                </button></a>
                                        </form>
                                    </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>



        </div>

    </div>

    <div class="container" style="height: 250px;">

    </div>

    <script>
        $(document).ready(function () {
        $('#archive').DataTable();
        });
    </script>


@endsection
