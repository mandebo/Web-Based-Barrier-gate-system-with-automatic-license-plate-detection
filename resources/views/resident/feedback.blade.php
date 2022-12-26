@extends('dashboard')

@section('feedback')

    <div class="container  p-5" style="margin-top: 70px">
{{--        First card--}}
        <div class="card " style="margin-top: 20px;">

            <div class="card-header align-content-center bg-info">
               <span style="color: white; font-size: 1.2rem; font-weight: bold; ">Tell us your problem</span>
            </div>

            <div class="card-body">

                <form action="{{ url('add-feedback') }}" method="post" enctype="multipart/form-data" class="mb-2">
                    @csrf
                    <div class="form-group">
                                <label for="exampleFormControlInput1" >Title</label>
                                <input  class="form-control" name="title" placeholder="example title">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Description</label>
                                <textarea class="form-control" name="description" rows="3" placeholder=""></textarea>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-lg-10">

                                    <input type="file" name="picture"/>

                                </div>
                                <div class="col-lg-2 ">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
                                    <td><button type="button" class="btn btn-info">Pending</button>
                                    </td>

                                @else
                                    <td><button type="button" class="btn btn-success">Checked</button>
                                    </td>

                                @endif


                                <td>  <a  class=""><button onclick="" type="button" class="btn btn-danger btn-size ">
                                            <svg class="" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16"><path fill="currentColor" d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/></svg>
                                        </button></a></td>

                            </tr>
                    @endforeach
                @endisset


            </tbody>
        </table>
    </div>

        <div class="container-lg">


        </div>


@endsection
