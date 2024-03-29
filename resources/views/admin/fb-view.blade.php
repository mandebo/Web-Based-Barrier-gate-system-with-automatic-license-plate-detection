@extends('admin.dashboard')

@section('fb-view')
    @if(Session::get('checked'))
        {{--        <div class="container">--}}
        {{--            <h1 style="margin-top: 100px;"> {{ Session::get('registered') }}</h1>--}}
        {{--        </div>--}}

        <script>
            Swal.fire({

                icon: 'success',
                title: 'Marked as checked!',
                showConfirmButton: false,
                timer: 1500
            })
        </script>



    @endif
    @if(Session::get('respond'))
        {{--        <div class="container">--}}
        {{--            <h1 style="margin-top: 100px;"> {{ Session::get('registered') }}</h1>--}}
        {{--        </div>--}}

        <script>
            Swal.fire({

                icon: 'success',
                title: 'Response added!',
                showConfirmButton: false,
                timer: 1500
            })
        </script>



    @endif

    <div class="container border rounded p-3" style="margin-top: 50px;box-shadow: 2px 2px lightblue;">
        <div class="row justify-content-end">
            <div class="col-lg-10">
                <p class="font-weight-bold" style="color: cornflowerblue"> Feedback Details</p>

            </div>
            <div class="col-lg-2">

                @foreach($feedbacks as $feedback)

                    @if($feedback->status == 0)
                        <button type="button" class="btn btn-info">Pending</button>

                    @else
                        <button type="button" class="btn btn-success">Checked</button>


                    @endif

                @endforeach


            </div>

        </div>

    </div>

    <div class="container border rounded p-3" style="margin-top: 10px;box-shadow: 2px 2px lightblue;">


        @foreach($users as $user)
            <div class="row">
                <div class="col-lg-1">
                    <p class="font-weight-bold" style="color: cornflowerblue">Name:</p>
                </div>
                <div class="col-lg-8">
                    <p class="font-weight-bold" style="color: cornflowerblue;">{{ $user->name }} </p>

                </div>
            </div>

            <div class="row">
                <div class="col-lg-1">
                    <p class="font-weight-bold" style="color: cornflowerblue">Room:</p>
                </div>
                <div class="col-lg-8">
                    <p class="font-weight-bold" style="color: cornflowerblue">{{ $user->room_no }} </p>

                </div>
            </div>

            <div class="row">
                <div class="col-lg-1">
                    <p class="font-weight-bold" style="color: cornflowerblue">Phone:</p>
                </div>
                <div class="col-lg-8">
                    <p class="font-weight-bold" style="color: cornflowerblue">{{ $user->phone_number }} </p>


                </div>
            </div>

        @endforeach



    </div>



    <div class="container border rounded p-3" style="margin-top: 25px;box-shadow: 2px 2px lightblue;">
        <div class="row">
            @foreach($feedbacks as $feedback)
                <div class="container col-lg-4 ">
                    <img class="card-img-top img-thumbnail  " src="{{asset('/storage/'.$feedback->picture)}}" style="height: 20rem; width: 20rem;" alt="Card image cap">
                </div>
                <div class=" container col-lg-8 border p-3" style="height: 20rem;">

                    <div class="row">
                        <div class="col-lg-1 font-weight-bold " >
                            Title:
                        </div>
                        <div class="col-lg-8 font-weight-bold">
                            <p style="padding-left: 5px;"> {{ $feedback->title }}</p>

                        </div>
                    </div>
                    <div class="row " style="margin-top: 10px;">

                        <div class="col-lg-8 align-items-center" style="text-align: justify;">
                           <p style="word-wrap: break-word;">{{ $feedback->content }}</p>
                        </div>
                    </div>


                </div>

            @endforeach


        </div>

        <div class="row" style="margin-top: 10px;">

            @foreach($feedbacks as $feedback)
                @if($feedback->status == 0)
                    <div class="col-lg-1">
                        <form action="{{ url( 'check', $feedback->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-success" style="margin-top: 10px;">Check</button>


                        </form>

                    </div>
                    <div class="col-lg-1" style="margin-left: 10px;">
                        <button  id="invi" type="button" class="btn btn-primary" style="margin-top: 10px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M9 11h9v2H9v-2m9-4H6v2h12V7m4-3v18l-4-4H4a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2m-2 0H4v12h14.83L20 17.17V4Z"/></svg>
                        </button>

                    </div>

                @endif


            @endforeach


        </div>

    </div>



        <div id="response" class=" container card response" style="margin-top: 20px;display: none;">
            <h5 class="card-header" style="color: cornflowerblue;">Add response</h5>
            <div class="card-body">
                <form action="{{ url( 'respond', $feedback->id) }}" id="respondForm" method="post">
                    @csrf
                    <textarea placeholder="Response" id="respond" name="respond" class="form-control" id="textAreaExample" rows="4"></textarea>


                    <button onclick="showAlert()" style="margin-top: 8px;" class="btn btn-primary">Submit</button>



                </form>
            </div>
        </div>

    @foreach($feedbacks as $feedback)
        @if($feedback->status == 1)
            <div id="kotak" class=" container card response" style="margin-top: 20px;box-shadow: 2px 2px lightblue;">
                <h5 class="card-header row" >
                    <div class="col-lg-11" style="color: cornflowerblue;">
                        Response
                    </div>
                    <div class="col-lg-1 justify-content-end " style="font-size: 15px;">
                        <button id="editbtn" class="btn" style="border: none;background: none; color: #007bff;"> Edit</button>
                    </div>
                </h5>
                <div class="card-body">
                    <p>
                        {{ $feedback->respond }}

                    </p>
                    <small class="text-muted">{{  Carbon\Carbon::parse($feedback->respond_time)->format('d-m-Y')}}</small>


                </div>
            </div>


        @endif

    @endforeach


    <div class="container" style="height: 200px;">

    </div>

    <script>
        const btn = document.getElementById('invi');
        var hint = document.getElementById('response');
        btn.addEventListener('click', () => {
            const form = document.getElementById('response');

            if (form.style.display === 'none') {
                // 👇️ this SHOWS the form
                form.style.display = 'block';
                hint.style.opacity = '1';
            } else {
                // 👇️ this HIDES the form
                form.style.display = 'none';
                hint.style.opacity = '0';
            }
        });

    </script>

    <script>
        const btn2 = document.getElementById('editbtn');
        btn2.addEventListener('click', () => {
            const form = document.getElementById('response');
            const kotak = document.getElementById('kotak');

            if (form.style.display === 'none') {
                // 👇️ this SHOWS the form
                form.style.display = 'block';
                kotak.style.display = 'none';

            } else {
                // 👇️ this HIDES the form
                form.style.display = 'none';

            }
        });

    </script>

    <script>
        function showAlert()
        {
            var respond = document.getElementById("respond").value;

            event.preventDefault();


            if(respond == "" )
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please input all fields'

                })
            }

            else
            {

                document.getElementById('respondForm').submit();

            }
        }

    </script>







@endsection
