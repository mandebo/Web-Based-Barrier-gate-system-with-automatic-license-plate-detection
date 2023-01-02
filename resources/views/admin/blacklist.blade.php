@extends('admin.dashboard')

@section('blacklist')
    @if(Session::get('blacklisted'))
        {{--        <div class="container">--}}
        {{--            <h1 style="margin-top: 100px;"> {{ Session::get('registered') }}</h1>--}}
        {{--        </div>--}}

        <script>
            Swal.fire({

                icon: 'warning',
                title: ' Blacklisted!',
                text:' vehicle is blacklisted',
                showConfirmButton: false,
                timer: 1500
            })
        </script>



    @endif
    @if(Session::get('duplicated'))

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

    <div class="container border rounded p-3 " style=" background-color:#54B4D3; margin-top: 20px;box-shadow: 2px 2px lightblue;">
                <p class="font-weight-bold" style="color: white;"> Blacklist</p>

    </div>

        <div class="card container  "style="box-shadow: 1px 1px lightblue;" id="regiFormCont" >
{{--            <div class=" card-header  align-content-center" style="background: none;">--}}
{{--               Blacklist vehicle--}}
{{--            </div>--}}
                <form action="{{ url('addbl') }}" method="post" id="blackForm">
                    {{--                    action="{{ url('addlp') method="post" }}"--}}
                    <div class="card-body ">

                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">License Plate</label>
                                <input  class="form-control" name="licenseplate" id="lp" aria-describedby="emailHelp" required placeholder="License plate">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Model</label>
                                <input  class="form-control" name="model" required id="model" placeholder="Phone number">
                            </div>



                        <div class="form-outline">
                            <label for="exampleInputPassword1">Reason</label>
                            <textarea placeholder="Reason" id="reason" name="reason" class="form-control" id="textAreaExample" rows="4"
                            style="width: 100%;"></textarea>

                        </div>

                        <button style="margin-top: 10px; font-size: 15px;" onclick="showAlert()" type="button" class="btn btn-danger"> Blacklist</button>



                    </div>
                </form>

                {{--            edit form--}}



        </div>

    <div class="container border rounded p-2" style="background-color: #54B4D3; margin-top: 50px;box-shadow: 1px 1px lightblue;">
        <p class="font-weight-bold" style="color: white"> Blacklisted vehicles</p>

    </div>

        <table class=" container rounded table border mt-4" id="archive">
            <thead class="thead-light " >
            <tr>
                <th scope="col">No</th>
                <th scope="col">License Plate</th>
                <th scope="col">Date</th>
                <th scope="col">Reason</th>
                <th></th>
            </tr>
            </thead>

            @foreach($blacklists as $black)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $black->lp }}</td>
                    <td>{{ $black->timestamp }}</td>
                    <td>{{ $black->reason }}</td>
                </tr>

            @endforeach

            <tbody>


            </tbody>
        </table>

    <div class="container" style="height: 200px;">

    </div>


    <script>
        function showAlert()
        {

            var lp = document.getElementById("lp").value;
            var model = document.getElementById("model").value;
            var reason = document.getElementById("reason").value;

            var first = lp.charAt(0);

            var check = isNaN(first);


            event.preventDefault();

            if(lp == '' || model == '' || reason =='' )
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please complete all fields'

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

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, add to blacklist!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('blackForm').submit();

                        }
                    })

                }


            }
        }

    </script>

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
                confirmButtonText: 'Yes, add to blacklist!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('blackForm').submit();
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )



                }
            })

        }
    </script>




@endsection
