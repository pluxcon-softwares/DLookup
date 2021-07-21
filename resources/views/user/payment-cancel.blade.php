@extends('layouts.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-exclamation-triangle"></i>
                  Payment Canceled
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="alert alert-danger alert-dismissible">
                  <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                  You have cancel your payment.. click the button below to continue <br>
                  <a href="{{route('user.dashboard')}}" class="btn btn-sm btn-info">Continue...</a>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
    </div>
@endsection
