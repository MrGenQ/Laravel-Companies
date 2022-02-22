@extends('main')
@section('content')
@include('_partials.dashboard-partial')
    <div class="container">
        <table class="table table-bordered table-responsive">
            <tr>
                <th>Product Name</th>
                <th>Barcode</th>
                <th>Price</th>
                <th>Person Ordered</th>
                <th>Ordered From</th>
            </tr>
            @foreach($orders as $order)
                <tr>
                    <th><div style="text-transform: uppercase">{{$order->product->product}}</div></th>
                    <th><div style="text-transform: uppercase">{{$order->product->barcode}}</div></th>
                    <th>{{$order->product->price}}</th>
                    <th>{{$order->user->name}}</th>
                    <th>{{$order->product->company->category->category}} "{{$order->product->company->company}}"</th>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
