@extends('admin.layouts.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xs-1-12 mt-5 mt-5">
            <h4>{{ $title }}</h4>
        </div>
    </div>

    @if(session('flash_message'))
    <div class="row justify-content-center" id="flash_message">
        <div class="col-xs-1-12 mt-5 mt-5">
            <div class="alert alert-success" role="alert">
                {{ session('flash_message') }}
            </div>
        </div>
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-xs-1-12 mt-3">
            <table id="user-table" class="table table-bordered table-primary table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                        <th scope="col">Wallet</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->active ? 'Enabled' : 'Disabled' }}</td>
                            <td>${{ $user->wallet }}</td>
                            <td><a href="{{ route('admin.edit-user', ['user_id' => $user->id]) }}"
                                class="btn btn-sm btn-info">Edit</a></td>
                            <td>
                                <a href="{{ route('admin.delete-user', ['user_id' => $user->id]) }}"
                                    class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('extra_script')
    <script>
        $(document).ready(function(){
            $('#user-table').DataTable();

            //Fade alert message
            $('#flash_message').fadeOut(3000);
        });
    </script>
@endsection
