@extends('main')
@section('content')
    <div class="container">
    <h2>Add new Category</h2>
    @include('_partials/errors')

    <form action="/create-category" method="post">
        @csrf
        <div class="form-group" style="width: 20em;">
            <input type="text" class="form-control" name="category" placeholder="Category title" >
        </div>
        <button type="submit" class="btn btn-primary" >Save</button>
    </form>
    </div>
@endsection
