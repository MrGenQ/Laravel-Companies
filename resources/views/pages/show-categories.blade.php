@extends('main')
@section('content')
    <div class='px-3 py-3'>
        <h2>Companies by Category</h2>
        <form class="d-flex">
            <div class="col-5 me-lg-4">
                <select name="category" class="form-select form-select-lg">
                    <option value="" selected disabled>--Choose Category--</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->category}}">{{$category->category}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary btn-lg">Filter</button>
            </div>
        </form>
        @if(empty($companies) === false)
            <table class="table table-bordered mt-4">
                <tr>
                    <th>Category</th>
                    <th>Company Name</th>
                    <th>Kodas</th>
                    <th>Director</th>
                    <th>More</th>
                </tr>
                @foreach ($companies as $company)
                    <tr>
                        <td><div style="text-transform: uppercase">{{$company->companyCategory}}</div></td>
                        <td><div style="text-transform: capitalize">{{$company->company}}</div></td>
                        <td>{{$company->code}}</td>
                        <td>{{$company->director}}</td>
                        <td><a href="/company/{{$company->id}}">More...</a></td>

                    </tr>
                @endforeach
            </table>
        @endif
    </div>
@endsection
