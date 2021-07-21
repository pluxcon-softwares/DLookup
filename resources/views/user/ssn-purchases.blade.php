@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-4 mt-5 mb-3">
            <h4>{{ $title }}</h4>
        </div>
    </div>

    @if(session('flash_message'))
    <div class="row">
        <div class="col-12 mt-1" style="text-align: center;">
            <div class="alert alert-danger" role="alert">
                {{ session('flash_message') }}
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-12">
            <table class="table table-primary table-responsive" id="ssnPurchaseTable">
                <thead>
                    <tr>
                        <th scope="col">{{__('Full Name')}}</th>
                        <th scope="col">{{__('DOB')}}</th>
                        <th scope="col">{{__('Gender')}}</th>
                        <th scope="col">{{__('SSN')}}</th>
                        <th scope="col">{{__('Address')}}</th>
                        <th scope="col">{{__('State')}}</th>
                        <th scope="col">{{__('City')}}</th>
                        <th scope="col">{{__('Zip')}}</th>
                        <th scope="col">{{__('Phone')}}</th>
                        <th scope="col">{{__('Email')}}</th>
                        <th scope="col">{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ssnOrders as $ssnOrder)
                        <tr>
                            <td>{{ $ssnOrder->first_name }} {{$ssnOrder->middle_name}} {{$ssnOrder->last_name}}</td>
                            <td>{{ $ssnOrder->dob }}</td>
                            <td>{{ $ssnOrder->gender ? 'Female' : 'Male' }}</td>
                            <td>{{ $ssnOrder->ssn }}</td>
                            <td>{{ $ssnOrder->address }}</td>
                            <td>{{ $ssnOrder->state }}</td>
                            <td>{{ $ssnOrder->city }}</td>
                            <td>{{ $ssnOrder->zip }}</td>
                            <td>{{ $ssnOrder->phone ? $ssnOrder->phone : 'N/A' }}</td>
                            <td>{{ $ssnOrder->email ? $ssnOrder->email : 'N/A' }}</td>
                            <td>
                                <form action="{{route('user.delete-ssn-purchase')}}" method="post">
                                    @csrf
                                <input type="hidden" name="ssn_id" value="{{$ssnOrder->ssn_id}}">
                                <button type="submit" class="btn btn-sm btn-danger">{{__('Delete')}}</button>
                                </form>
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
            $("#ssnPurchaseTable").DataTable();
        });
    </script>
@endsection
