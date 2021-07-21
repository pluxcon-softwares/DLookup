@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-6 mt-5">
        <h3>{{ $title }}</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 mt-1" style="text-align: center;">
        <div class="alert alert-info" role="alert">
            {{__('Note: DL Search - if record found $30 will be dedicted from your wallet and record found automatically will be added to your DL purchase table at the top of the menu. GOOD LUCK!')}}
        </div>
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

@if (isset($flash_message))
<div class="row">
    <div class="col-12 mt-1" style="text-align: center;">
        <div class="alert alert-info" role="alert">
            {{ $flash_message }}
          </div>
    </div>
</div>
@endif

<div class="row">
    <div class="col-md-4 col-sm-12">
        <form action="{{ route('user.dl.search') }}" method="POST" class="form">
            @csrf

            <div class="form-group mr-1">
                <input type="text" name="first_name" class="form-control form-control-sm" placeholder="{{__('First Name*')}}" value="{{old('first_name')}}">
                <span class="badge badge-pill badge-warning">{{ $errors->first('first_name') }}</span>
            </div>

            <div class="form-group mr-1">
                <input type="text" name="last_name" class="form-control form-control-sm" placeholder="{{__('Last Name*')}}" value="{{old('last_name')}}">
                <span class="badge badge-pill badge-warning">{{ $errors->first('last_name') }}</span>
            </div>

            <div class="form-group mr-1">
                <input type="date" name="dob" class="form-control form-control-sm" placeholder="{{__('DOB(mm/dd/yyy)')}}*" value="{{old('dob')}}">
                <span class="badge badge-pill badge-warning">{{ $errors->first('dob') }}</span>
            </div>

            <div class="form-group mr-1">
                <input type="text" name="address" class="form-control form-control-sm" placeholder="{{__('Address*')}}" value="{{old('address')}}">
                <span class="badge badge-pill badge-warning">{{ $errors->first('address') }}</span>
            </div>

            <div class="form-group mr-1">
                <input type="text" name="zip" class="form-control form-control-sm" placeholder="{{__('ZIP*')}}" value="{{old('zip')}}">
                <span class="badge badge-pill badge-warning">{{ $errors->first('zip') }}</span>
            </div>

            <div class="form-group mr-1">
                <input type="text" name="city" class="form-control form-control-sm" placeholder="{{__('City*')}}" value="{{old('city')}}">
                <span class="badge badge-pill badge-warning">{{ $errors->first('city') }}</span>
            </div>

            <div class="form-group mr-1 mt-2">
                <select name="state" class="form-control form-control-sm">
                    <option value="">{{__('Select State(*)')}}</option>
                    @foreach ($states as $state)
                        <option value="{{ $state->id }}">{{$state->code}} - {{$state->state}}</option>
                    @endforeach
                </select>
                <span class="badge badge-pill badge-warning">{{ $errors->first('dob') }}</span>
            </div>

            <div class="form-group mr-1 mt-2">
                <button type="submit" class="btn btn-sm btn-primary">{{__('Search DL')}}</button>
            </div>

            </form>
    </div>

    <div class="col-md-8 col-sm-12">
        <table class="table table-responsive" id="ssn_records_table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">{{__('Fullname')}}</th>
                <th scope="col">{{__('DOB')}}</th>
                <th scope="col">{{__('DL_Number')}}</th>
                <th scope="col">{{__('Gender')}}</th>
                <th scope="col">{{__('Address')}}</th>
                <th scope="col">{{__('State')}}</th>
                <th scope="col">{{__('Buy')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($dl_records as $dl_record)
                <tr>
                    <td>
                        {{$dl_record->first_name}}
                        {{ $dl_record->middle_name ? $dl_record->middle_name : ''}}
                        {{ $dl_record->last_name }}
                    </td>
                    <td>{{ $dl_record->dob }}</td>
                    <td>{{ $dl_record->dl_number }}</td>
                    <td>{{ $dl_record->gender ? 'Male' : 'Female' }}</td>
                    <td>{{ $dl_record->address }}</td>
                    <td>{{ $dl_record->state->state }}</td>
                    <td>
                        <a href="{{ route('user.view-dl-purchase') }}" class="btn btn-sm btn-info">{{__('Full Details')}}</a>
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
