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
                            <div class="card mb-4" style="height: 322px;">
                                <div class="card-body ">
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                                         class="rounded-circle img-fluid" style="width: 150px;">

                                    @foreach($profiles as $profile)
                                        <h5 class="my-3">{{ $profile->name }}</h5>
                                    @endforeach

                                </div>
                            </div>

                        </div>
                        <div class="col-lg-8">
                            <div class="card mb-4 " >
                                <div class="card-body">

                                    @foreach($profiles as $profile)
                                        <div class="row">

                                            <div class="col-sm-3">
                                                <p class="mb-0">Full Name</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class=" mb-0">{{ $profile->name }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Email</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class=" mb-0">{{ $profile->email }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Registered at</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class=" mb-0">{{  Carbon\Carbon::parse($profile->created_at)->format('d-m-Y')}}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Phone no</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="mb-0">{{ $profile->phone_number }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Room no</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class=" mb-0">{{ $profile->room_no }}</p>
                                            </div>
                                        </div>

                                        <hr>

                                    @endforeach

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">License Plates</p>
                                        </div>
                                        <div class="col-sm-9">
                                            @foreach($cars as $car)
                                                <p style="color: green;"> {{ $car->lp }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>



                </div>
                <div class=" bg-info rounded " style="height: 30px;"></div>
            </div>

            <div class="pt-1">
                <form action=" {{ url( 'resident-info') }}">
                    <button class="btn btn-info" type="submit">Back</button>

                </form>


            </div>







        </div>



@endsection
