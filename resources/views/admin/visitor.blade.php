@extends('admin.dashboard')

@section('visitor')
    @if(Session::get('success'))
        {{--        <div class="container">--}}
        {{--            <h1 style="margin-top: 100px;"> {{ Session::get('registered') }}</h1>--}}
        {{--        </div>--}}

        <script>
            Swal.fire({

                icon: 'success',
                title: 'Visitor added',
                showConfirmButton: false,
                timer: 1500
            })
        </script>

    @endif
    @if(Session::get('not_exist'))

        {{--        <div class="container">--}}
        {{--            <h1 style="margin-top: 100px;"> {{ Session::get('duplicate') }}</h1>--}}
        {{--        </div>--}}

        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'The room does not have owner'

            })
        </script>

    @endif
    @if(Session::get('duplicated'))

        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Visitor is still active'

            })
        </script>

    @endif

    <div class="container border rounded p-3" style=" background-color:#54B4D3; margin-top: 50px;box-shadow: 2px 2px lightblue;">
        <p class="font-weight-bold"  style="color: white;"> Manage Visitors</p>
    </div>

    <div class="container border rounded p-5" style="box-shadow: 1px 1px lightblue;">
        <form action="{{ url('addv') }} " method="post">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">License Plate</label>
                <input  class="form-control" name="lp" id="lp" aria-describedby="emailHelp" required placeholder="License plate">
{{--                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Phone no</label>
                <input  class="form-control" name="phone" required id="phone" placeholder="Phone number">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Owner Room</label>
                <input  class="form-control" id="room" required  name="room" placeholder="Room destination">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Visitation date</label>

                <div class="row">
                    <div class="p-2" style="margin-left: 10px;">
                        <input class="col-sm-5 col-md-5 col-lg-5" required name="dateFrom" id="dateFrom" type="date" min="2022-01-01"   name="datepick" style="outline: blue">
                        To :  <input class="col-sm-5 col-md-5 col-lg-5" required  name="dateTo" id="dateTo" type="date" min="2022-01-01"    name="datepick" style="outline: blue">
                    </div>


                </div>


            </div>




            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>

    <div class="container border rounded  p-3" style="margin-top: 50px; box-shadow: 2px 2px lightblue;">
        <p> Active visitors</p>
    </div>



    <div class="container rounded p-3  border" style="margin-top: 20px;box-shadow: 2px 2px lightblue;">
        <table class="table" id="data-table2">
            <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">License Plate</th>
                <th scope="col">Phone number</th>
                <th scope="col">Room</th>
                <th scope="col">From</th>
                <th scope="col">To</th>



            </tr>
            </thead>
            <tbody>

            @foreach($visitors as $v)
                <tr>
                    <td> {{ $loop -> iteration }}</td>
                    <td> {{ $v-> lp }}</td>
                    <td> {{ $v-> phone }}</td>
                    <td> {{ $v-> room }}</td>
                    <td> {{  Carbon\Carbon::parse($v->datefrom)->format('d-m-Y')}}</td>
                    <td> {{  Carbon\Carbon::parse($v->dateto)->format('d-m-Y')}}</td>





                </tr>

            @endforeach

            </tbody>



        </table>

    </div>

    <div class="container" style="margin-top: 100px;">

    </div>




    <script>
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!
        var yyyy = today.getFullYear();



        if (dd < 10) {
            dd = '0' + dd;
        }

        if (mm < 10) {
            mm = '0' + mm;
        }

        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById("dateFrom").setAttribute("min", today);
        document.getElementById("dateTo").setAttribute("min", today);
    </script>


@endsection
