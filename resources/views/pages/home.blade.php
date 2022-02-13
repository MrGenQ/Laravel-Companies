<?php
use App\Models\Company;
    ?>
@extends('main')
@section('content')
<div class="container-fluid">
        <form style="display: flex; flex-direction: row; gap: 15px;">
        <div style="display: flex; flex-direction: column;" class="form-select-lg"><label>Pavadinimas</label>
            <select class="form-select" name="companyName" style="width: 20em; height: 3em;">

                <option value="" selected disabled>--Choose Company--</option>
                @foreach ($filterNames as $name)
                    <option value="{{$name}}">{{$name}}</option>
                @endforeach
            </select>
        </div>
        <div style="display: flex; flex-direction: column;" class="form-select-lg"><label>Code</label>
            <input class="form-control" name="companyCode" style="width: 20em; height: 3em;"/>
        </div>
        <div style="display: flex; flex-direction: column;" class="form-select-lg"><label>Data Registered</label>
            <select class="form-select" name="registerDate" style="width: 20em; height: 3em;">
                <option value="asc">Newest</option>
                <option value="desc">Oldest</option>
            </select>
        </div>
        <div style="padding-top: 1.5%;">
            <button class="btn btn-primary" type="submit">Filtruoti</button>
        </div>
        </form>
    <h1 class="mt-4">Companies</h1>

    <table class="table table-bordered table-responsive">
        <tr>
            <th>Category</th>
            <th>Company name</th>
            <th>Code</th>
            <th>PVM Code</th>
            <th>More</th>
            <th>Actions</th>
        </tr>
            @foreach($filtered as $company)
                <tr>
                    <th><div style="text-transform: uppercase">{{$company->companyCategory}}</div></th>
                    <th><div style="text-transform: capitalize">{{$company->company}}</div></th>
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
    {{$filtered->links()}}
</div>
@endsection
