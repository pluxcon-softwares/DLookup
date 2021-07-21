@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-6 mt-5">
            <h4>{{ $title }}</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header">
                    <form action="{{route('user.process-fund')}}" method="POST" class="">
                        @csrf
                        <div class="row">
                            <div class="col-10">
                                <div class="form-group">
                                    <input type="text" name="fund" class="form-control" placeholder="{{__('Amount')}}">
                                    <small style="font-size: 12px; color: red;">{{$errors->first('fund')}}</small>
                                  </div>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary btn-sm">{{__('Add')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="callout callout-danger">
                    <h5>{{__('Payment Transaction')}}</h5>

                    <table id="transactionTable" class="table table-info">
                        <thead>
                            <tr>
                                <th scope="col" style="">BTC Address</th>
                                <th scope="col" style="">Transaction ID</th>
                                <th scope="col">USD</th>
                                <th scope="col" style="">BTC</th>
                                <th scope="col" style="">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $p)
                                <tr>
                                    <td>{{ $p->address }}</td>
                                    <td>{{ $p->transaction_id }}</td>
                                    <td>{{ $p->local_amount }}</td>
                                    <td>{{ $p->bitcoin_amount }}</td>
                                    <td>
                                        @switch($p->status)
                                            @case('confirmed')
                                                <span class="badge badge-pill badge-success">Confirmed</span>
                                                @break

                                            @case('created')
                                                <span class="badge badge-pill badge-primary">Pending</span>
                                            @break

                                            @case('pending')
                                                <span class="badge badge-pill badge-info">Pending</span>
                                            @break

                                            @case('failed')
                                                <span class="badge badge-pill badge-danger">Failed</span>
                                            @break

                                            @case('delayed')
                                                <span class="badge badge-pill badge-success">Confirmed</span>
                                            @break
                                        @endswitch
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
        </div>
    </div>
@endsection

@section('extra_script')
    <script>
        $(document).ready(function(){
            $('#transactionTable').DataTable();
        });
    </script>
@endsection
