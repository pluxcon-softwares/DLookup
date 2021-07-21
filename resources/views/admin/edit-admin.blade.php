@extends('admin.layouts.master')

@section('content')

    <div class="row justify-content-center">
        <div class="col-xs-5 mt-5 mt-5">
            <h4>{{ $title }}</h4>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-4" style="padding: 20px; background-color:#303030; color: #fff;">
            <form action="{{ route('admin.update-admin', ['admin_id'=>$admin->id]) }}" method="post">
                @csrf
            <div class="form-group">
              <label for="">Username</label>
              <input type="text" name="name" value="{{ $admin->name }}" class="form-control">
              <small style="font-size: 12px; color:yellow">{{$errors->first('name')}}</small>
            </div>

            <div class="form-group">
                <label for="">Email</label>
                <input type="text" name="email" value="{{ $admin->email }}" class="form-control">
                <small style="font-size: 12px; color:yellow">{{$errors->first('email')}}</small>
            </div>

            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary btn-sm">Update Admin</button>
                    </div>
                    <div class="col-6">
                        <a href="{{route('admin.all-admins')}}" class="btn btn-info btn-sm">back to admins account</a>
                    </div>
                </div>
            </div>

            </form>
        </div>
    </div>
@endsection
