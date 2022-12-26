@extends('dashboard')

@section('register')
    @if(Session::get('registered'))
{{--        <div class="container">--}}
{{--            <h1 style="margin-top: 100px;"> {{ Session::get('registered') }}</h1>--}}
{{--        </div>--}}

        <script>
            Swal.fire({

                icon: 'success',
                title: 'You license plate is registered',
                showConfirmButton: false,
                timer: 1500
            })
        </script>



    @endif

    @if(Session::get('duplicate'))

{{--        <div class="container">--}}
{{--            <h1 style="margin-top: 100px;"> {{ Session::get('duplicate') }}</h1>--}}
{{--        </div>--}}

        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'License plate already exist in record'

            })
        </script>

    @endif




{{--License plate records--}}
    <div class="container align-content-center  lp-record rounded border " style="width: 58% !important;" >
        <table class="table table-hover smol-font  ">
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

                    <td >{{$record->lp}}</td>
                    <td>{{$record->model}}</td>
                    <td>{{Carbon\Carbon::parse($record->timestamp)->format('h:i')}}</td>
                    <td>{{Carbon\Carbon::parse($record->timestamp)->format('d-m-Y')}}</td>

                    <input id="recordlp" type="text" style="display: none;" value="{{ $record->lp }}">

                    <td class="row">

                            <form class="col-lg-3 col-md-3 col-sm-3 col-3" action="{{ url('fetchedit',[$record->user_id,$record->car_id]) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-size ">Edit</button>
                            </form>

                        <form class=" col-lg-4 col-md-4 col-sm-4 col-4" action="{{ url('deletefetch',$record->car_id) }}" id="deleteForm">
                            <a  href="deletefetch/{{ $record->car_id }}" class=""><button onclick="" type="button" class="btn btn-danger btn-size ">
                                    <svg class="" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16"><path fill="currentColor" d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/></svg>
                                </button></a>
                        </form>
                    </td>
{{--                    <td> <i class="bi bi-trash-fill"></i></td>--}}
                </tr>



            @endforeach

            </tbody>
        </table>


    </div>

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

{{--Register card--}}
    <div class="container registration "  >
        <div class="card " id="regiFormCont" >
            <div class="card-header align-content-center">
                Please insert vehicle details
            </div>
            @if($counter < 2)
                <form action="{{ url('addlp') }}" method="post" id="regiForm">
{{--                    action="{{ url('addlp') method="post" }}"--}}
                    <div class="card-body ">
                        <div class="row g-3">
                            @if(Session::get('succ'))
                                <div class="alert alert-success">
                                    {{Session::get('succ')}}
                                </div>

                            @endif
                            @if(Session::get('fail'))
                                <div class="alert alert-success">
                                    {{Session::get('fail')}}
                                </div>
                            @endif

                            @csrf
                            <div class="col-sm-5 form-group">
                                <div class="form-outline">
                                    <input autofocus type="text" id="licenseplate" name="licenseplate" class="form-control"  placeholder="License plate" />
{{--                                    <span style="color: red">@error('licenseplate'){{$message}}@enderror </span>--}}

                                </div>
                            </div>
                            <div class="col-sm form-group">
                                <div class="form-outline">
                                    <input type="text" id="model" name="model" class="form-control"  placeholder="Vehicle model" />
{{--                                    <span style="color: red">@error('model'){{$message}}@enderror </span>--}}
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="">
                                    <button onclick="showAlert()"  class="btn btn-primary">submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

{{--            edit form--}}


                <script>
                    function showAlert()
                    {


                        // var dups = document.getElementById("recordlp").value;
                        // alert(dups);
                        var lp = document.getElementById("licenseplate").value;
                        var model = document.getElementById("model").value;
                        var first = lp.charAt(0);

                        var check = isNaN(first);


                        event.preventDefault();

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
                            if(!check)
                            {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Please enter a valid license plate format'

                                })
                            }
                            else
                            {

                                document.getElementById('regiForm').submit();

                            }


                        }
                    }

                </script>


{{--                script for toggeling edit form--}}

                <script>
                    function hideContent() {
                        var x = document.getElementById("regiForm");
                        var y = document.getElementById("licenseplate");

                        // var value = document.getElementById("licenseplate").value;

                       var value = document.getElementById("recordlp").value;

                        // if (x.style.display === "none") {
                        //     x.style.display = "block";
                        // } else {
                        //     x.style.display = "none";
                        // }
                    }
                </script>
            @else
                <form action="{{ url('addlp') }}" method="post">
                    <div class="card-body ">
                        <div class="row g-3">
                            @if(Session::get('success'))
                                <div class="alert alert-success">
                                    {{Session::get('success')}}
                                </div>

                            @endif
                            @if(Session::get('fail'))
                                <div class="alert alert-success">
                                    {{Session::get('fail')}}
                                </div>
                            @endif

                            @csrf
                            <div class="col-sm-5 form-group">
                                <div class="form-outline">
                                    <input type="text" id="licenseplate" name="licenseplate" disabled class="form-control" placeholder="License plate" />
                                    <span style="color: red">@error('licenseplate'){{$message}}@enderror </span>

                                </div>
                            </div>
                            <div class="col-sm form-group">
                                <div class="form-outline">
                                    <input type="text" id="model" name="model" disabled class="form-control" placeholder="Vehicle model" />
                                    <span style="color: red">@error('model'){{$message}}@enderror </span>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="">
                                    <button class="btn btn-primary" disabled type="submit">submit</button>
                                </div>
                            </div>
                        </div>
                        <div style="color: red; font-size: x-small"><span>*You have reached maximum number of registered vehicles</span></div>

                    </div>
                </form>
            @endif
        </div>



{{--            edit form--}}



        <div class="container-xl registration " style="display: none;" >
            @if(empty($record))

            @else
                <div class="card" id="editForm">
                    <div class="card-header align-content-center">
                        Edit insert vehicle details
                    </div>

                    <form action="editlp/{{$record->car_id}}" method="post" id="editForm2">
                        {{--                    action="{{ url('addlp') method="post" }}"--}}
                        <div class="card-body ">
                            <div class="row g-3">

                                @csrf
                                <div class="col-sm-5 form-group">
                                    <div class="form-outline " >
                                        <input  autofocus type="text" id="editlp" name="editlp" class="form-control"   placeholder="License plate" value="{{$record->lp}}"/>
                                        {{--                                    <span style="color: red">@error('licenseplate'){{$message}}@enderror </span>--}}

                                    </div>
                                </div>
                                <div class="col-sm form-group">
                                    <div class="form-outline">
                                        <input type="text" id="editmodel" name="editmodel" class="form-control "  placeholder="Vehicle model" value="{{$record->model}}" />
                                        {{--                                    <span style="color: red">@error('model'){{$message}}@enderror </span>--}}
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="">
                                      <a href="editlp/{{$record->car_id}}"><button onclick="showEdit()"  class="btn btn-primary">submit</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

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

            </div>







@endsection
