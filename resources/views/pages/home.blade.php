@extends('main')
@section('content')
<div class="container-fluid">
    <h1 class="mt-4">All Companies</h1>

    <table class="table table-bordered table-responsive">
        <tr>
            <th>Company name</th>
            <th>Code</th>
            <th>PVM Code</th>
            <th>More</th>
            <th>Actions</th>
        </tr>
            @foreach($companies as $company)
                <tr>
                    <th>{{$company->company}}</th>
                    <th>{{$company->code}}</th>
                    <th>{{$company->vat}}</th>
                    <th><a href="/company/{{$company->id}}">More...</a></th>
                    <th>
                        <ul>
                            <li><a href="/delete/company/{{$company->id}}">Remove</a></li>
                            <li><a href="/update/company/{{$company->id}}">Update</a></li>
                        </ul>
                    </th>
                </tr>
            @endforeach
    </table>
    {{$companies->links()}}
</div>
@endsection
