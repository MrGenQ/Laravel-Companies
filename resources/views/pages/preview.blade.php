@extends('main')
@section('content')
<div class="container">
    <form action="/" method="post" enctype="multipart/form-data">
        @csrf
        <div>
        <button type="submit" class="btn btn-primary">Add Import</button>
        <a href="/" class="btn alert-danger">Cancel</a>
        </div>
    @foreach($file as $array)
        <div class="card">
        <h2>Company information:</h2>
        @foreach($array as $company)
            <div class="card-body">
                @if(Str::startsWith($company, 'http') === true)
                <img style="width: 25em" src="{{$company}}" alt="img">

                @else
                    {{$company}}
                @endif

            </div>
        @endforeach
        </div>
    @endforeach
    </form>
</div>
@endsection
