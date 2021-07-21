@extends('admin.layouts.master')

@section('content')

    <div class="row justify-content-md-center">
        <div class="col-md-12 mt-3 mb-3" style="text-align: center;">
            <h3>{{ $title }}</h3>
        </div>
    </div>

    <div class="row justify-content-md-center">
        @if(Session::has('flash_message'))
            <div class="alert alert-primary" role="alert">
                {{Session::get('flash_message')}}
            </div>
        @endif
    </div>

    <form action="{{route('admin.ssn.update', ['ssn_id' => $ssn_record->id])}}" method="POST">
        @csrf
        <div class="row justify-content-md-center">

            <div class="col-md-4">

                <div class="form-group">
                    <input type="text" name="first_name" value="{{ $ssn_record->first_name }}" placeholder="First Name (*)" class="form-control form-control-sm">
                    <small style="color:red; font-size: 0.8rem">{{$errors->first('first_name')}}</small>
                </div>

                <div class="form-group">
                    <input type="text" name="middle_name" value="{{$ssn_record->middle_name}}" placeholder="Middle Name" class="form-control form-control-sm">
                </div>

                <div class="form-group">
                    <input type="text" name="last_name" value="{{ $ssn_record->last_name }}" placeholder="Last Name (*)" class="form-control form-control-sm">
                    <small style="color:red; font-size: 0.8rem">{{$errors->first('last_name')}}</small>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            Date Of Birth
                        </div>
                        <div class="col-8">
                            <input type="date" name="dob" value="{{ $ssn_record->dob }}" placeholder="DOB - (MM/DD/YYY)" class="form-control form-control-sm">
                            <small style="color:red; font-size: 0.8rem">{{$errors->first('dob')}}</small>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <select name="gender" class="form-control form-control-sm">
                        <option value="">Select Gender</option>
                        <option value="0" {{ $ssn_record->gender == 0 ? 'selected' : '' }}>Male</option>
                        <option value="1" {{ $ssn_record->gender == 1 ? 'selected' : '' }}>Female</option>
                    </select>
                    <small style="color:red; font-size: 0.8rem">{{$errors->first('dob')}}</small>
                </div>

                <div class="form-group">
                    <input type="text" name="ssn" value="{{ $ssn_record->ssn }}" placeholder="SSN (*)" class="form-control form-control-sm">
                    <small style="color:red; font-size:0.8rem">{{$errors->first('ssn')}}</small>
                </div>

                <div class="form-group">
                    <input type="text" name="address" value="{{ $ssn_record->address }}" placeholder="Address (*)" class="form-control form-control-sm">
                    <small style="color:red; font-size:0.8rem">{{$errors->first('address')}}</small>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <select name="state" class="form-control form-control-sm">
                        <option value="">Select State</option>
                        @foreach($states as $state)
                        <option value="{{ $state->id }}"
                            {{$state->id == $ssn_record->state->id ? 'selected' : ''}}>
                            {{$state->code}} - {{$state->state}}
                        </option>
                        @endforeach
                    </select>
                    <small style="color:red; font-size: 0.8rem">{{$errors->first('state')}}</small>
                </div>

                <div class="form-group">
                    <input type="text" name="city" value="{{ $ssn_record->city }}" placeholder="City (*)" class="form-control form-control-sm">
                    <small style="color:red; font-size: 0.8rem">{{$errors->first('city')}}</small>
                </div>

                <div class="form-group">
                    <input type="text" name="zip" value="{{ $ssn_record->zip }}" placeholder="Zip (*)" class="form-control form-control-sm">
                    <small style="color:red; font-size: 0.8rem">{{$errors->first('zip')}}</small>
                </div>

                <div class="form-group">
                    <input type="text" name="phone" value="{{ $ssn_record->phone }}" placeholder="Phone (optional)" class="form-control form-control-sm">
                </div>

                <div class="form-group">
                    <input type="text" name="email" value="{{ $ssn_record->email }}" placeholder="Email (Optional)" class="form-control form-control-sm">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-info btn-sm">Update</button>
                </div>

                <div class="form-group">
                    <a href="{{route('admin.ssn.records')}}" class="btn btn-sm btn-primary"><< Back to Records</a>
                </div>
            </div>
        </div>
    </form>

@endsection
