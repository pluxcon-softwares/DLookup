@extends('admin.layouts.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-5 mt-5 mb-3" style="text-align: center">
            <div class="alert alert-primary" role="alert">
                <h4>{{ $title }} @if(isset($paymentTotal)) - {{ $paymentTotal }} @endif</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <table class="table table-primary table-sm" id="allPaymentTable">
                <thead>
                    <tr>
                        <th role="col" style="width: 100px;">Username</th>
                        <th role="col" style="width: 450px;">TransactionID</th>
                        <th role="col" style="width: 50px;">Amount(USD)</th>
                        <th role="col" style="width: 50px;">Amount(BTC)</th>
                        <th role="col" style="width: 100px;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $p)
                        <tr>
                            <td>{{$p->customer_name}}</td>
                            <td>{{$p->transaction_id}}</td>
                            <td>{{$p->local_amount}}</td>
                            <td>{{$p->bitcoin_amount}}</td>
                            <td>{{$p->status}}</td>
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
            $('#allPaymentTable').DataTable();
        });
    </script>
@endsection
