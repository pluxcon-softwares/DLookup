@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-12 mt-3 mb-3">
            <h4>{{$title}}</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>
                  {{ $numberOfSSN ? $numberOfSSN->count() : 0 }}
              </h3>

              <p>Social Security Number</p>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{$numberOfDL ? $numberOfDL->count() : 0}}</h3>

              <p>Drivers License</p>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $numberOfUsers ? $numberOfUsers->count() : 0 }}</h3>

              <p>User Registrations</p>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{ $numberOfAdmins ? $numberOfAdmins->count() : 0 }}</h3>

              <p>Administrators</p>
            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>

      <div class="row mt-3">
        <div class="col-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Sales</span>
                <span class="info-box-number">${{$paymentAmounts ? sprintf("%.2f",$paymentAmounts) : 0}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

        <div class="col-9">
              <table class="table table-primary" id="paymentsTable">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Amount(USD)</th>
                        <th>Amount(BTC)</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allPayments as $p)
                    <tr>
                        <td>{{$p->customer_name}}</td>
                        <td>{{$p->local_amount}}</td>
                        <td>{{$p->bitcoin_amount}}</td>
                        <td>{{$p->status}}</td>
                        <td>{{$p->updated_at->diffForHumans()}}</td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
          </div>
      </div>

@endsection
