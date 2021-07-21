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

    <form action="{{route('admin.ssn.store')}}" method="POST">
        @csrf
        <div class="row justify-content-md-center">

            <div class="col-md-4">

                <div class="form-group">
                    <input type="text" name="first_name" placeholder="First Name (*)" class="form-control form-control-sm">
                    <small style="color:red; font-size: 0.8rem">{{$errors->first('first_name')}}</small>
                </div>

                <div class="form-group">
                    <input type="text" name="middle_name" placeholder="Middle Name" class="form-control form-control-sm">
                </div>

                <div class="form-group">
                    <input type="text" name="last_name" placeholder="Last Name (*)" class="form-control form-control-sm">
                    <small style="color:red; font-size: 0.8rem">{{$errors->first('last_name')}}</small>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            Date of Birth
                        </div>
                        <div class="col-8">
                            <input type="date" name="dob" placeholder="DOB - (MM/DD/YYYY)" class="form-control form-control-sm">
                            <small style="color:red; font-size: 0.8rem">{{$errors->first('dob')}}</small>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <select name="gender" class="form-control form-control-sm">
                        <option value="">Select Gender</option>
                        <option value="0">Male</option>
                        <option value="1">Female</option>
                    </select>
                    <small style="color:red; font-size: 0.8rem">{{$errors->first('gender')}}</small>
                </div>

                <div class="form-group">
                    <input type="text" name="ssn" placeholder="SSN (*)" class="form-control form-control-sm">
                    <small style="color:red; font-size:0.8rem">{{$errors->first('ssn')}}</small>
                </div>

                <div class="form-group">
                    <input type="text" name="address" placeholder="Address (*)" class="form-control form-control-sm">
                    <small style="color:red; font-size:0.8rem">{{$errors->first('address')}}</small>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <select name="state" class="form-control form-control-sm">
                        <option value="">Select State</option>
                        @foreach($states as $state)
                        <option value="{{$state->id}}">{{ $state->code }} - {{ $state->state }}</option>
                        @endforeach
                    </select>
                    <small style="color:red; font-size: 0.8rem">{{$errors->first('state')}}</small>
                </div>

                <div class="form-group">
                    <input type="text" name="city" placeholder="City (*)" class="form-control form-control-sm">
                    <small style="color:red; font-size: 0.8rem">{{$errors->first('city')}}</small>
                </div>

                <div class="form-group">
                    <input type="text" name="zip" placeholder="Zip (*)" class="form-control form-control-sm">
                    <small style="color:red; font-size: 0.8rem">{{$errors->first('zip')}}</small>
                </div>

                <div class="form-group">
                    <input type="text" name="phone" placeholder="Phone (optional)" class="form-control form-control-sm">
                </div>

                <div class="form-group">
                    <input type="text" name="email" placeholder="Email (Optional)" class="form-control form-control-sm">
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <button type="submit" class="btn btn-block btn-primary btn-sm">Add</button>
                        </div>

                        <div class="col-6">
                            <a href="{{ route('admin.ssn.records') }}" class="btn btn-block btn-warning btn-sm">Back to Records</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
