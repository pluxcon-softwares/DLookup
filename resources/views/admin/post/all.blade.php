@extends('admin.layouts.master')

@section('content')
    <div class="col-3" style="text-align: center; padding: 30px 0 20px 0;">
        <h4>{{$title}}</h4>
    </div>

    @if(Session::has('flash_message'))
    <div class="col-12 mt-1" style="text-align: center;">
        <div class="alert alert-success" role="alert">
            {{ Session::get('flash_message') }}
        </div>
    </div>
    @endif

    <div class="col-12">
        <table class="table" id="newsTable">
            <thead class="thead-dark">
              <tr>
                <th scope="col" style="width: 700px;">News</th>
                <th scope="col">Created At</th>
                <th scope="col">&nbsp;</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>{{ $post->content }}</td>
                    <td>{{ __($post->created_at->diffForHumans()) }}</td>
                    <td>
                        <a href="{{route('admin.news.edit', ['post_id'=>$post->id])}}"
                            class="btn btn-primary btn-sm">Edit</a>
                    </td>
                    <td>
                        <form action="{{route('admin.news.delete')}}" method="POST">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                  </tr>
                @endforeach
            </tbody>
          </table>
    </div>

@endsection

@section('extra_script')
<script>
    $(document).ready(function(){
        $("#newsTable").DataTable();
    });
</script>
@endsection
