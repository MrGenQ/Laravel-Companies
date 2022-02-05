@extends('main')
@section('content')

    <form enctype='multipart/form-data' action='/preview' method='post'>
        @csrf
        <label><h4>Upload Product CSV file Here</h4></label>
        <div>
        <input type='file' name='file'>
        <button type="submit" class="btn btn-primary" >Data Preview</button>
            <a href="/" class="btn alert-danger">Cancel</a>
        </div>
    </form>

@endsection
