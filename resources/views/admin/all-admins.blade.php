@extends('admin.layouts.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xs-1-6 mt-5 mt-5">
            <h4>{{ $title }}</h4>
        </div>
        <div class="col-xs-4 mt-5 mt-5 ml-3">
            <a href="{{ route('admin.create-admin') }}" class="btn btn-primary">Create New Admin</a>
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
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                        <tr>
                            <td>{{ $admin->id }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>
                                @if ($admin->name == 'system')
                                    &nbsp;
                                @else
                                <a href="{{ route('admin.edit-admin', ['admin_id' => $admin->id]) }}"
                                    class="btn btn-sm btn-info">Edit</a>
                                @endif
                            </td>
                            <td>
                                @if ($admin->name == 'system')
                                    &nbsp;
                                @else
                                <a href="{{ route('admin.delete-admin', ['admin_id' => $admin->id]) }}"
                                    class="btn btn-sm btn-danger">Delete</a>
                                @endif
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
