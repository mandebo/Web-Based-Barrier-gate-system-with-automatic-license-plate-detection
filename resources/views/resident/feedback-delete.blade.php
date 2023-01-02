@extends('dashboard')

@section('feedback')
    @if(Session::get('feedbacksuccess'))
        {{--        <div class="container">--}}
        {{--            <h1 style="margin-top: 100px;"> {{ Session::get('registered') }}</h1>--}}
        {{--        </div>--}}

        <script>
            Swal.fire({

                icon: 'success',
                title: 'We notified the admin about your feedback',
                showConfirmButton: false,
                timer: 1500
            })
        </script>



    @endif



        <script>

            window.addEventListener('load', function () {


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


                        document.getElementById('deletefb').submit();

                        {{--window.location = "anndelete/{{ $announcement -> announcement_id }}";--}}
                        {{--window.location.href = 'anndelete/{{ $announcement->announcement_id }}';--}}

                    }
                    else
                    {
                        document.getElementById('feedb').submit();

                    }

                })
            })


        </script>






        @foreach($deletes as $d)
            <form action="{{ url('fbgone',$d->id) }}" method="post" id="deletefb" style="display: none;">
                @csrf


            </form>

        @endforeach
    <form action="{{ url('feedback') }}" method="get" id="feedb" style="display: none;">
        @csrf


    </form>






    <div class="container  p-5" style="margin-top: 70px">
        {{--        First card--}}
        <div class="card " style="margin-top: 20px;">

            <div class="card-header align-content-center bg-info">
                <span style="color: white; font-size: 1.2rem; font-weight: bold; ">Tell us your problem</span>
            </div>

            <div class="card-body">

                <form id="fbform" action="{{ url('add-feedback') }}" method="post" enctype="multipart/form-data" class="mb-2">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1" >Title</label>
                        <input  class="form-control" id="title" name="title" placeholder="example title">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Description</label>
                        <textarea maxlength="200" class="form-control" id="description" name="description" rows="3" placeholder=""></textarea>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-lg-10">

                            <input type="file" name="picture"/>

                        </div>
                        <div class="col-lg-2 ">
                            <button onclick="showAlert()" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
            </div>
            </form>


        </div>

        <span class="badge badge-info" style="font-size: 1.2rem;margin-top: 25px;"> Submitted feedback</span>
        <table  class="feedback-table rounded table table-striped   border  table-responsive-xl" id="capture" style="width:100%;">
            <thead class="bg-info" >
            <tr>
                <th style="color: white;">No</th>
                <th style="color: white;">Title</th>
                <th style="color: white;">Time</th>
                <th style="color: white;">Date</th>
                <th style="color: white;">Status</th>
                <th></th>

            </tr>
            </thead>
            <tbody>


            @isset($feedbacks)
                @foreach($feedbacks as $feedback)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $feedback->title }}</td>
                        <td>{{  Carbon\Carbon::parse($feedback->timestamp)->format('d-m-Y')}}</td>
                        <td>{{  Carbon\Carbon::parse($feedback->timestamp)->format('h:i:s')}}</td>

                        @if($feedback->status == "0")
                            <td>
                                <form action="{{ url( 'res-fb', $feedback->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-info" style="font-size: 12px;">Pending</button>
                                </form>

                            </td>

                        @else
                            <td>
                                <form action="{{ url( 'res-fb', $feedback->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-success" style="font-size: 12px;">Checked</button>
                                </form>
                            </td>

                        @endif


                        <td>
                            <form class="pr-1" action="{{ url('deletefb',$feedback->id) }}" id="deleteForm" method="post">
                                @csrf
                                <a  href="fbdelete/{{ $feedback->id }}" class=""><button  style="font-size: 12px;" type="button" class="btn btn-danger btn-size ">
                                        <svg class="" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16"><path fill="currentColor" d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/></svg>
                                    </button></a>

                            </form></td>

                    </tr>
                @endforeach
            @endisset


            </tbody>
        </table>
    </div>

    <div class="container-lg">


    </div>

    <script>
        function showAlert()
        {


            // var dups = document.getElementById("recordlp").value;
            // alert(dups);
            var lp = document.getElementById("title").value;
            var model = document.getElementById("description").value;

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
                document.getElementById('fbform').submit();

            }
        }

    </script>




@endsection
