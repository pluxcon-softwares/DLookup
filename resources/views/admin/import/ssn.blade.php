@extends('admin.layouts.master')

@section('content')

    <div class="row justify-content-center">
        <div class="col-4 mt-5">
            <h4>{{ $title }}</h4>
        </div>
    </div>

    @if (session('status'))
    <div class="row justify-content-center">
        <div class="col-4 mt-5">
           <h5>{{ session('status') }}</h5>
        </div>
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-4 mt-5">
            <form action="{{ route('admin.ssn-parse-import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="">Choose CSV File</label>
                  <input type="file" name="file" id="" class="form-control">
                  <small style="font-size: 12px; color:red;">{{$errors->first('file')}}</small>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-block btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>

@endsection
