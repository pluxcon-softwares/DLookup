@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-6 mt-4" style="overflow-y: scroll; height: 500px;">
        <h4><i class="fas fa-bullhorn" aria-hidden="true"></i> {{__('News')}}</h4>
        @if ($news->count() == 0)
            <div class="callout callout-danger">
                <h4>{{__('News not available')}}</h4>
            </div>
        @else
            @foreach ($news as $n)
            <div class="callout callout-success">
                <span style="color: red; font-size:12px; margin: 0 0 50px 0;"><i class="fa fa-calendar" aria-hidden="true"></i> {{ $n->created_at->diffForHumans() }}</span>
                <p>{{$n->content}}</p>
            </div>
            @endforeach
        @endif

    </div>

    <div class="col-6 mt-4">
        <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-bullhorn"></i>
                {{__('Our Services')}}
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="callout callout-info">
                <h5>{{__('Drivers License(DL)')}}</h5>

                <p>{{__('Search through our mass valid drivers license DL database')}}</p>
              </div>
              <div class="callout callout-info">
                <h5>{{__('SSN/DOB')}}</h5>

                <p>
                    {{__('We have our 1million valid Social Security Numbers SSN with DOBs install in our database. Start searching now!')}}
                </p>
              </div>
              <div class="callout callout-info">
                <h5>{{__('Email Flooding')}}</h5>

                <p>
                    {{__('Coming Soon! - We are developing powerful mass email flooder to help you succed mail flooding')}}
                </p>
              </div>
              <div class="callout callout-info">
                <h5>{{__('Shipping Labels')}}</h5>

                <p>
                    {{__('Coming Soon! - Get yourself prepared shipping label services.')}}
                </p>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
    </div>
</div>

@endsection

@section('extra_script')

@endsection
