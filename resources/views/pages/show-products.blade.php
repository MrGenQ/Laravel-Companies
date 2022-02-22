@extends('main')
@section('content')
    @include('_partials.dashboard-partial')
    <table class="table table-bordered mt-4">
        <tr>
            <th>Product</th>
            <th>Barcode</th>
            <th>Price</th>
            <th>Manufacturer</th>
            <th>Order</th>
        </tr>
        @foreach ($products as $product)
            <tr>
                <td><div style="text-transform: capitalize">{{$product->product}}</div></td>
                <td>{{$product->barcode}}</td>
                <td>{{$product->price}}</td>
                <td><div style="text-transform: capitalize">{{$product->company->company}}</div></td>
                <td><a href="/add-orders/order/{{$product->id}}" class="btn btn-success">Add to Cart</a></td>

            </tr>
        @endforeach
    </table>
@endsection
