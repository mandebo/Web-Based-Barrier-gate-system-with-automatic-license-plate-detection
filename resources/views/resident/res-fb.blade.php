@extends('dashboard')

@section('res-fb')

    <div class="container border rounded p-3" style="margin-top: 100px;box-shadow: 2px 2px lightblue;">
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





    <div class="container border rounded p-3" style="margin-top: 25px;box-shadow: 2px 2px lightblue; height: 400px;">
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
    </div>






    @foreach($feedbacks as $feedback)


        @if($feedback->respond == "")

        @else
            <div id="kotak" class=" container card response" style="margin-top: 20px;box-shadow: 2px 2px lightblue;">
                <h5 class="card-header row" >
                    <div class="col-lg-11" style="color: cornflowerblue;">
                        Response
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
    <div class="container" style="margin-top: 10px;"> <a href="{{ url('feedback') }}"><button style="font-size: 12px;" class="btn-primary btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m3 12l7-9v4.99L21 8v8H10v5l-7-9Z"/></svg>
            </button></a>
    </div>






        <div class="container" style="height: 200px; padding: 0px;">

        </div>



@endsection
