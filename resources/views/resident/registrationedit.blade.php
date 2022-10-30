@extends('dashboard')

@section('registeredit')


    {{--License plate records--}}
    <div class="container align-content-center  lp-record rounded border " >
        <table class="table table-hover ">
            <thead>
            <th>License Plate</th>
            <th>Model</th>
            <th>Time</th>
            <th>Date</th>
            <th></th>
            </thead>

            @if(empty($records))
                <tbody>
                <tr>
                    <td></td>
                    <td style="color: red;">No record found</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>

            @endif


            <tbody>
            @foreach( $records as $record)


                <tr>

                    <td id="recordlp">{{$record->lp}}</td>
                    <td>{{$record->model}}</td>
                    <td>{{Carbon\Carbon::parse($record->timestamp)->format('h:i')}}</td>
                    <td>{{Carbon\Carbon::parse($record->timestamp)->format('d-m-Y')}}</td>

                    <td class="row">

                        <form class="pr-1" action="{{ url('fetchedit',[$record->user_id,$record->car_id]) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </form>

                        <form class="pr-1" action="{{ url('deletelp',$record->car_id) }}" id="deleteForm">
                            <a class=""><button onclick="showDelete()" type="button" class="btn btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16"><path fill="currentColor" d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/></svg>
                                </button></a>
                        </form>
                    </td>
                    {{--                    <td> <i class="bi bi-trash-fill"></i></td>--}}
                </tr>



            @endforeach

            </tbody>
        </table>


    </div>

    {{--@if(Session::get('deleted'))--}}
    {{--    <div class="alert alert-success container">--}}
    {{--        {{Session::get('deleted')}}--}}
    {{--    </div>--}}

    {{--@endif--}}

    {{--Register card--}}



        {{--            edit form--}}

<div class="container">
    <div class="container-xl registration " >
        @if(empty($edits))
            <h1> edits variable not fetched</h1>
        @else
            @foreach($edits as $edit)
                <div class="card" id="editForm">
                    <div class="card-header align-content-center">
                        Edit insert vehicle details
                    </div>

                    <form action=" {{ url('editlp',$edit->car_id) }}" method="post" id="editForm2">
                        {{--                    action="{{ url('addlp') method="post" }}"--}}
                        <div class="card-body ">
                            <div class="row g-3">

                                @csrf
                                <div class="col-sm-5 form-group">
                                    <div class="form-outline " >
                                        <input  autofocus type="text" id="editlp" name="editlp" class="form-control"   placeholder="License plate" value="{{$edit->lp}}"/>
                                        {{--                                    <span style="color: red">@error('licenseplate'){{$message}}@enderror </span>--}}

                                    </div>
                                </div>
                                <div class="col-sm form-group">
                                    <div class="form-outline">
                                        <input type="text" id="editmodel" name="editmodel" class="form-control "  placeholder="Vehicle model" value="{{$edit->model}}" />
                                        {{--                                    <span style="color: red">@error('model'){{$message}}@enderror </span>--}}
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="">
                                        <a href="editlp/{{$edit->car_id}}"><button onclick="showEdit()"  class="btn btn-primary">submit</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>


                    @endforeach
                    @endif





                {{--                script for toggeling edit form--}}

                <script>
                    function hideContent() {
                        var x = document.getElementById("regiFormCont");
                        var y = document.getElementById("editForm");

                        var lp = document.getElementById("editlp");


                        x.replaceWith(y);
                        y.style.display = "block";



                        // if (x.style.display === "none") {
                        //     x.style.display = "block";
                        // } else {
                        //     x.style.display = "none";
                        // }
                    }
                </script>
                    <script>
                        function showDelete()
                        {
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

                                    document.getElementById('deleteForm').submit();

                                }
                            })

                        }
                    </script>
                <script>
                    function showEdit()
                    {
                        var lp = document.getElementById("editlp").value;
                        var model = document.getElementById("editmodel").value;
                        event.preventDefault();
                        // document.getElementById('regiForm').submit();

                        if(lp == '' || model == '' )
                        {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Please enter both field'

                            })
                        }
                        else
                        {
                            document.getElementById('editForm2').submit();
                            Swal.fire({

                                icon: 'success',
                                title: 'Your record is updated',
                                showConfirmButton: false,
                                timer: 1500
                            })


                        }
                    }

                </script>

            </div>


    </div>





@endsection
