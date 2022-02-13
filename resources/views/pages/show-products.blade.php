@extends('main')
@section('content')
    <table class="table table-bordered mt-4">
        <tr>
            <th>Product</th>
            <th>Barcode</th>
            <th>Price</th>
            <th>Placed Order In</th>
            <th>Order</th>
        </tr>
        @foreach ($products as $product)
            <tr>
                <td><div style="text-transform: capitalize">{{$product->product}}</div></td>
                <td>{{$product->barcode}}</td>
                <td>{{$product->price}}</td>
                <td><div style="text-transform: capitalize">{{$product->company}}</div></td>
                <td><a href="/add-orders" class="btn btn-success">Add to Cart</a></td>

            </tr>
        @endforeach
    </table>
@endsection
