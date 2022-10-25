@extends('dashboard')

@section('view_announcement')


       @foreach($annviews as $annview)
            <div class="container card p-5 " style="width: 50rem;margin-top: 100px;width: 100%;height: auto;">
                <img class="border" src="{{asset('/storage/'.$annview->image)}}" style="height: 20rem;" alt="Card image cap">

                <div class="card-body">
                    <h2 class="font-monospace border-bottom pb-2"> {{$annview->title}}</h2>
                    <p class="card-text text-justify border-bottom pb-2">{{$annview->content}}</p>
                    <p><small class="text-muted">Posted at {{  Carbon\Carbon::parse($annview->timestamp)->format('d-m-Y')}}</small>
                    </p>
                    <a href="{{ url('res_announcement') }}"><button class="btn-primary btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m3 12l7-9v4.99L21 8v8H10v5l-7-9Z"/></svg>
                        </button></a>
                </div>
            </div>
        @endforeach
@endsection