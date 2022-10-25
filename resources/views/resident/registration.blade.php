@extends('dashboard')

@section('register')


{{--License plate records--}}
    <div class="container align-content-center  lp-record rounded border ">
        <table class="table table-hover ">
            <thead>
                 <th>License Plate</th>
                 <th>Model</th>
                 <th>Time registered</th>
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

                    <td>{{$record->lp}}</td>
                    <td>{{$record->model}}</td>
                    <td>{{$record->timestamp}}</td>
                    <td><a href="deletelp/{{$record->car_id}}"><button type="button" class="btn btn-danger">

                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16"><path fill="currentColor" d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/></svg>

                            </button></a></td>
{{--                    <td> <i class="bi bi-trash-fill"></i></td>--}}
                </tr>


            @endforeach

            </tbody>
        </table>
    </div>

@if(Session::get('deleted'))
    <div class="alert alert-success container">
        {{Session::get('deleted')}}
    </div>

@endif

{{--Register card--}}
    <div class="container registration ">
        <div class="card">
            <div class="card-header align-content-center">
                Please insert vehicle details
            </div>
            @if($counter < 2)
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
                                    <input type="text" id="licenseplate" name="licenseplate" class="form-control"  placeholder="License plate" />
                                    <span style="color: red">@error('licenseplate'){{$message}}@enderror </span>

                                </div>
                            </div>
                            <div class="col-sm form-group">
                                <div class="form-outline">
                                    <input type="text" id="model" name="model" class="form-control"  placeholder="Vehicle model" />
                                    <span style="color: red">@error('model'){{$message}}@enderror </span>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="">
                                    <button class="btn btn-primary" type="submit" >submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
                            <div style="color: red; font-size: x-small"><span>*You have reached maximum number of registered vehicles</span></div>
                        </div>
                    </div>
                </form>
            @endif
        </div>

{{--<div class="container registration">--}}
{{--    <form action="{{ url('addlp') }}" method="post">--}}
{{--        @csrf--}}
{{--        --}}
{{--        --}}
{{--        <label for="fname">First name:</label><br>--}}
{{--        <input type="text" id="fname" name="fname" value="John"><br>--}}
{{--        <label for="lname">Last name:</label><br>--}}
{{--        <input type="text" id="lname" name="lname" value="Doe"><br><br>--}}
{{--        <input type="submit" value="Submit">--}}
{{--    </form>--}}


{{--</div>--}}


@endsection
