@extends('main')
@section('content')
    <div class="container-fluid">
        <h2 class="mt-4">Company information</h2>
        <div class="card" style="width: 30rem;">
            <div class="card-body" style="background: lightgray">
                <h2 class="card-title" style="color: darkgoldenrod; text-transform: capitalize">Company name: <p>{{$company->company}}</p></h2>
                <div style="color: darkgreen">
                    <p class="card-text">Code: {{$company->code}}</p>
                    <p class="card-text">PVM Code: {{$company->vat}}</p>
                    <p class="card-text">Director: {{$company->director}}</p>
                    <p class="card-text">Address: {{$company->address}}</p>
                    <p class="card-text">Category: {{$company->category->category}}</p>
                    <p class="card-text">Description: {{$company->description}}</p>
                </div>
            </div>
            <div class="card-footer">
                @if($company->logo)
                    @if(Str::startsWith($company->logo, 'http') === true)
                        <img style="width: 25em" src="{{$company->logo}}" alt="">
                    @endif
                    <img style="width: 28rem" src="{{ asset('/storage/'.$company->logo) }}" alt="">
                @endif
            </div>
        </div>
        <form action="/company/{{$company->id}}/comment" method="post">
            @csrf
            <div class="form-group" style="width: 30em;">
                <textarea name="body" class="form-control" placeholder="Jusu komentaras"></textarea>
            </div>
            <div class="form-group">
                <button type="submit">Komentuoti</button>
            </div>
        </form>

        <div>
            <h3>Komentarai</h3>
            @if(count($company->comments))
                @foreach($company->comments as $comment)
                    <div>
                        <div>{{$comment->user->name}} rase:</div>
                        <div>{{$comment->body}}</div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
