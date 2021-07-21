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
                        <th scope="col">{{__('Gende')}}r</th>
                        <th scope="col">{{__('Issue Date')}}</th>
                        <th scope="col">{{__('Expire Date')}}</th>
                        <th scope="col">{{__('DL Number')}}</th>
                        <th scope="col">{{__('Class')}}</th>
                        <th scope="col">{{__('Address')}}</th>
                        <th scope="col">{{__('City')}}</th>
                        <th scope="col">{{__('State')}}</th>
                        <th scope="col">{{__('Zip')}}</th>
                        <th scope="col">{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dlPurchases as $dl)
                        <tr>
                            <td>{{ $dl->first_name }} {{$dl->middle_name}} {{$dl->last_name}}</td>
                            <td>{{ $dl->dob }}</td>
                            <td>{{ $dl->gender ? 'Female' : 'Male' }}</td>
                            <td>{{ $dl->issue_date }}</td>
                            <td>{{ $dl->expire_date }}</td>
                            <td>{{ $dl->dl_number }}</td>
                            <td>{{ $dl->class ? $dl->class : 'N/A' }}</td>
                            <td>{{ $dl->address }}</td>
                            <td>{{ $dl->city }}</td>
                            <td>{{ $dl->state }}</td>
                            <td>{{ $dl->zip}}</td>
                            <td>
                                <form action="{{route('user.delete-dl-purchase')}}" method="post">
                                    @csrf
                                <input type="hidden" name="dl_id" value="{{$dl->dl_id}}">
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
