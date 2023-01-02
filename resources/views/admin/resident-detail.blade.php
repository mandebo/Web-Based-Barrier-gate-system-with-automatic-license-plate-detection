@extends('admin.dashboard')
@section('resident-profile')



        <div class="container  p-5 ">

            <div class="card border">
                <div class="card-header bg-info" style="color: white;">
                    <span class="badge badge-info " style="font-size: 1.2rem;"> Residents Profile</span>
                </div>
                <div class="card-body bg-light">
                    <div class="row ">
                        <div class="col-lg-4 text-center" >
                            <div class="card mb-4" style="height: 300px;">
                                <div class="card-body " >
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                                         class="rounded-circle img-fluid" style="width: 150px;">

                                </div>
                            </div>

                        </div>
                        <div class="col-lg-8">
                            <div class="card mb-4 " >
                                <div class="card-body">

                                    @foreach($profiles as $profile)
                                        <div class="row" >

                                            <div class="col-sm-3">
                                                <p style="font-weight: bold; font-size: 12px;" class="mb-0">Full Name</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p style="font-size: 12px;" class=" mb-0">{{ $profile->name }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p style="font-weight: bold;font-size: 12px; " class="mb-0">Email</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p style="font-size: 12px;" class=" mb-0">{{ $profile->email }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p style="font-weight: bold;font-size: 12px;" class="mb-0">Registered at</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p style="font-size: 12px;" class=" mb-0">{{  Carbon\Carbon::parse($profile->created_at)->format('d-m-Y')}}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p style="font-weight: bold;font-size: 12px;" class="mb-0">Phone no</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p style="font-size: 12px;" class="mb-0">{{ $profile->phone_number }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p style="font-weight: bold;font-size: 12px;" class="mb-0">Room no</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p style="font-size: 12px;" class=" mb-0">{{ $profile->room_no }}</p>
                                            </div>
                                        </div>

                                        <hr>

                                    @endforeach

{{--                                    <div class="row">--}}
{{--                                        <div class="col-sm-3">--}}
{{--                                            <p class="mb-0">License Plates</p>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-9">--}}
{{--                                            @foreach($cars as $car)--}}
{{--                                                <p style="color: green;"> {{ $car->lp }}</p>--}}
{{--                                            @endforeach--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class=" rounded border p-3" style="background-color:white;width: 100%; height: 200px; margin-left: 5px;">
                        <span class="badge badge-primary badge-pill">Registered vehicle</span>

                        @if($count2 > 0)
                            @foreach($cars as $car)

                                <table  class="table" style=" margin-top:10px; width: 100%;">
                                    <thead>
                                    <tr style="font-size: 12px;">
                                        <th scope="col">No</th>
                                        <th scope="col">License Plate</th>
                                        <th scope="col">Vehicle Model</th>
                                        <th scope="col">Date Registered</th>
                                        <th scope="col">Time Registered</th>



                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr style="font-size: 12px;">
                                        <td> {{ $loop->iteration }}</td>
                                        <td>{{ $car->lp }}</td>
                                        <td>{{ $car->model }}</td>
                                        <td>{{  Carbon\Carbon::parse($car->timestamp)->format('d-m-Y')}}</td>
                                        <td>{{  Carbon\Carbon::parse($car->timestamp)->format('h:i:s')}}</td>



                                    </tr>
                                    </tbody>
                                </table>

                            @endforeach

                        @else
                            <table  class="table" style=" margin-top:10px; width: 100%;">
                                <thead>
                                <tr style="font-size: 12px;">
                                    <th scope="col">No</th>
                                    <th scope="col">License Plate</th>
                                    <th scope="col">Vehicle Model</th>
                                    <td></td>
                                    <th scope="col">Date Registered</th>
                                    <th scope="col">Time Registered</th>



                                </tr>
                                </thead>
                                <tbody>
                                <tr style="font-size: 12px;">
                                    <td> </td>
                                    <td></td>
                                    <td></td>
                                    <td style=" margin-left:10px; color: red;"> No Registered License Plate</td>
                                    <td></td>
                                    <td></td>



                                </tr>
                                </tbody>
                            </table>


                        @endif



                    </div>

                    <div class=" rounded border p-3" style="margin-top:10px;background-color:white;width: 100%; height: 170px; margin-left: 5px;">
                        <span class="badge badge-success badge-pill">Active Visitor</span>

                        @if($count > 0)
                            @foreach($visitor as $v)
                                <table  class="table" style=" margin-top:10px; width: 100%;">
                                    <thead>
                                    <tr style="font-size: 12px;">
                                        <th scope="col">No</th>
                                        <th scope="col">License Plate</th>
                                        <th scope="col">Phone number</th>
                                        <th scope="col">From</th>
                                        <th scope="col">To</th>



                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr style="font-size: 12px;">
                                        <td> {{ $loop->iteration }}</td>
                                        <td>{{ $v->lp }}</td>
                                        <td>{{ $v->phone }}</td>
                                        <td>{{  Carbon\Carbon::parse($v->datefrom)->format('d-m-Y')}}</td>
                                        <td>{{  Carbon\Carbon::parse($v->dateto)->format('d-m-Y')}}</td>



                                    </tr>
                                    </tbody>
                                </table>
                            @endforeach

                        @else
                            <table  class="table" style=" margin-top:10px; width: 100%;">
                                <thead>
                                <tr style="font-size: 12px;">
                                    <th scope="col">No</th>
                                    <th scope="col">License Plate</th>
                                    <th scope="col">Phone number</th>
                                    <th scope="col">From</th>
                                    <th scope="col">To</th>



                                </tr>
                                </thead>
                                <tbody>
                                <tr style="font-size: 12px;">
                                    <td> </td>
                                    <td></td>
                                    <td style="color: red;">No Active Visitors</td>
                                    <td></td>
                                    <td></td>



                                </tr>
                                </tbody>
                            </table>

                        @endif









                    </div>



                </div>



            </div>

            <div class="pt-1">
                <form action=" {{ url( 'resident-info') }}">
                    <button class="btn btn-info" type="submit">Back</button>

                </form>


            </div>







        </div>



@endsection
