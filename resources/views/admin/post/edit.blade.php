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
    </div>
    @endif
    <div class="col-6 offset-3">
        <form action="{{route('admin.news.update', ['post_id' => $post->id])}}" method="POST">
            @csrf
        <div class="form-group">
          <label for=""></label>
          <textarea type="text" rows="7" name="content" class="form-control" placeholder="Add News Content" >{{$post->content}}</textarea>
          <small id="helpId" style="font-size:12px; color:red;">{{$errors->first('content')}}</small>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-block btn-sm">Update News</button>
        </div>
        </form>
    </div>
@endsection

@section('extra_script')

@endsection
