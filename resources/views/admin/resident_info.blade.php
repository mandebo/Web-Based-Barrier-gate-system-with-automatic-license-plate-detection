@extends('admin.dashboard')
@section('resident_info')

    <div class="container mt-5 ">

        <div class="pb-3">
            <span class="badge badge-info " style="font-size: 1.2rem;"> Residents Information</span>

        </div>



        <table class="table border">
            <thead class="thead-light">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone no</th>
                <th scope="col">Room no</th>


                <th scope="col"></th>
            </tr>
            </thead>
            @foreach($records as $record)
            <tbody>
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>

                    <td>{{$record->name}}</td>
                    <td>{{ $record->email }}</td>
                    <td>{{ $record-> phone_number}}</td>
                    <td>{{ $record-> room_no }}</td>
                    <td><a href="resident-detail/{{ $record->id }}"><button class="btn btn-primary" data-toggle="modal" data-target="myModal">Details</button></a></td>


            </tr>
            </tbody>
            @endforeach
        </table>
    </div>




@endsection
