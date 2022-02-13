@extends('main')
@section('content')
    <div class="container">
        <h2>Add new Product</h2>
        @include('_partials/errors')

        <form action="/create-product" method="post">
            @csrf
            <div class="form-group" style="width: 20em;">
                <input type="text" class="form-control" name="product" placeholder="Product Name" >
            </div>
            <div class="form-group" style="width: 20em;">
                <input type="text" class="form-control" name="barcode" placeholder="Barcode" >
            </div>
            <div class="form-group" style="width: 20em;">
                <input type="text" class="form-control" name="price" placeholder="Price" >
            </div>
            <div class="form-group" style="width: 20em;">
                <label>Choose Company</label>
                <select type="text" class="form-control" name="company">
                    <option value="" selected disabled>--Company--</option>
                    @foreach($companies as $company)
                        <option value="{{$company}}">{{$company}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary" >Save</button>
        </form>
    </div>
@endsection
