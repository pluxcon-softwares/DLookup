@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-3 offset-3 mt-5 bt-3">
            <h4>{{$title}}</h4>
        </div>
    </div>
    @if(session('flash_message'))
    <div class="row">
        <div class="col-3 offset-3 mt-3 mb-3">
            <div class="alert alert-success" role="alert">
                {{ session('flash_message') }}
            </div>
        </div>
        <div class="col-3 mt-3 mb-3">
            <a href="{{route('admin.news.posts')}}" class="btn btn-success"><< Back to Posts</a>
        </div>
    </div>
    @endif
    <div class="col-6 offset-3">
        <form action="{{route('admin.news.store')}}" method="POST">
            @csrf
        <div class="form-group">
          <label for=""></label>
          <textarea type="text" rows="7" name="content" class="form-control" placeholder="Add News Content" ></textarea>
          <small id="helpId" style="font-size:12px; color:red;">{{$errors->first('content')}}</small>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-block btn-sm">Add News</button>
        </div>
        </form>
    </div>
@endsection

@section('extra_script')

@endsection
