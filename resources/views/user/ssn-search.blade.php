@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-6  mt-5">
        <h3>{{ $title }}</h3>
    </div>
</div>

@if(Session::has('flash_message'))
<div class="row">
    <div class="col-12 mt-1" style="text-align: center;">
        <div class="alert alert-success" role="alert">
            {{ Session::get('flash_message') }}
          </div>
    </div>
</div>
@endif

@if(isset($flash_message) && ($flash_message !== null))
<div class="row">
    <div class="col-12 mt-1" style="text-align: center;">
        <div class="alert alert-success" role="alert">
            {{ $flash_message }}
          </div>
    </div>
</div>
@endif

@if(count($errors) > 0)
<div class="row">
    @foreach ($errors->all() as $error)
    <div class="col-2 mt-1" style="text-align: center;">
        <div class="alert alert-danger" role="alert">
            {{ $error }}
          </div>
    </div>
    @endforeach
</div>
@endif

<div class="row">
    <div class="col-12" style="background-color: #bbb; padding: 12px;">
        <form action="{{ route('user.ssn-search') }}" method="POST" class="form-inline">
        @csrf
        <div class="form-group mr-1">
            <input type="text" name="first_name" class="form-control form-control-sm" placeholder="{{__('First name*')}}" value="{{ old('first_name') }}">
        </div>
        <div class="form-group mr-1">
            <input type="text" name="last_name" class="form-control form-control-sm" placeholder="{{__('Last name*')}}" value="{{ old('last_name') }}">
        </div>
        <div class="form-group mr-1">
            <input type="text" name="address" class="form-control form-control-sm" placeholder="{{__('Address*')}}" value="{{ old('address') }}">
        </div>
        <div class="form-group mr-1">
            <input type="text" name="zip" class="form-control form-control-sm" placeholder="{{__('ZIP*')}}" value="{{ old('zip') }}">
        </div>
        <div class="form-group mr-1">
            <input type="text" name="state" class="form-control form-control-sm" placeholder="{{__('State (Optional)')}}" value="{{ old('state') }}">
        </div>
        <div class="form-group mr-1">
            <button type="submit" class="btn btn-sm btn-primary">{{__('Search')}}</button>
        </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-12 mt-5" style="font-size: 14px;">
        <table class="table" id="ssn_records_table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">{{__('Fullname')}}</th>
                <th scope="col">{{__('DOB')}}</th>
                <th scope="col">{{__('SSN')}}</th>
                <th scope="col">{{__('Gender')}}</th>
                <th scope="col">{{__('State')}}</th>
                <th scope="col">{{__('Address')}}</th>
                <th scope="col">{{__('Buy')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($ssn_records as $ssn_record)
                <tr>
                    <td>
                        {{$ssn_record->first_name}}
                        {{ $ssn_record->middle_name ? $ssn_record->middle_name : ''}}
                        {{ $ssn_record->last_name }}
                    </td>
                    <td>{{ $ssn_record->dob }}</td>
                    <td>{{ $ssn_record->ssn }}</td>
                    <td>{{ $ssn_record->gender ? 'Female' : 'Male' }}</td>
                    <td>{{ $ssn_record->state->state }}</td>
                    <td>{{ $ssn_record->address }}</td>
                    <td>
                        <form action="{{route('user.ssn-buy')}}" method="POST">
                        @csrf
                        <input type="hidden" name="price" value="5">
                        <input type="hidden" name="ssn_id" value="{{ $ssn_record->id }}">
                        <button type="submit">Buy-($5.00)</button>
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
        jQuery().ready(function($){
            $('#ssn_records_table').DataTable();
        })
    </script>
@endsection
