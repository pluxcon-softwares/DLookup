@extends('admin.layouts.master')

@section('content')
<h3 style="padding: 30px 0 20px 0;">{{$title}}</h3>

<div class="col-md-12">
    @if(Session::has('flash_message'))
        <div class="alert alert-primary" role="alert">
            {{Session::get('flash_message')}}
        </div>
    @endif
</div>

<div class="col-md-12">
    <table class="table" id="dl_records_table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Fullname</th>
            <th scope="col">DOB</th>
            <th scope="col">Gender</th>
            <th scope="col">DL</th>
            <th scope="col">Class</th>
            <th scope="col">Issue Date</th>
            <th scope="col">Expire Date</th>
            <th scope="col">Details</th>
          </tr>
        </thead>
        <tbody>
            @if(count($dl_records) > 0)
                @foreach($dl_records as $dl_record)
                <tr>
                    <th scope="row">{{$dl_record->id}}</th>
                    <td>{{ $dl_record->first_name }} {{ $dl_record->middle_name ? $dl_record->middle_name : '' }} {{ $dl_record->last_name }}</td>
                    <td>{{ $dl_record->dob }}</td>
                    <td>{{ $dl_record->gender ? 'Female' : 'Male' }}</td>
                    <td>{{ $dl_record->dl_number }}</td>
                    <td>{{ $dl_record->class ? $dl_record->class : 'None' }}</td>
                    <td>{{ $dl_record->issue_date}}</td>
                    <td>{{ $dl_record->expire_date}}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-primary view_dl_record"
                        data-view_dl_record="{{$dl_record->id}}">View</a>
                        <a href="{{route('admin.dl.edit', ['dl_id'=>$dl_record->id])}}" class="btn btn-sm btn-info">Edit</a>
                        <a href="{{route('admin.dl.delete', ['dl_id'=>$dl_record->id])}}" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                  </tr>
                @endforeach
            @endif
        </tbody>
      </table>

</div>

<div class="row">
<!-- Modal -->
<div class="modal fade" id="viewDlRecord" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">DL Record</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <!-- content here -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection


@section('extra_script')
    <script>
        jQuery(document).ready(function($){
            // Fetch SSN Record by ID
            $('a.view_dl_record').on('click', function(evt){
                var dl_record_id = evt.currentTarget.dataset['view_dl_record'];
                $.ajax({
                    url: '/admin/dl/record/'+ dl_record_id,
                    method: 'GET',
                }).then(function(res){
                    var dlRecordData = `
                    <h6>Full Name: ${res.data.first_name} ${res.data.middle_name ? res.data.middle_name : ''} ${res.data.last_name}</h6>
                    <p>DOB: ${res.data.dob}</p>
                    <p>Gender: ${res.data.gender ? 'Female' : 'Male'}</p>
                    <p>DL Number: ${res.data.dl_number}</p>
                    <p>Class: ${res.data.class ? res.data.class : 'None'}</p>
                    <p>Issue Date: ${res.data.issue_date}</p>
                    <p>Expire Date: ${res.data.expire_date}</p>
                    <p>State: ${res.data.state.state}</p>
                    <p>City: ${res.data.city}</p>
                    <p>Zip: ${res.data.zipcode}</p>
                    `;
                    $('#viewDlRecord .modal-body').empty();
                    $('#viewDlRecord .modal-body').append(dlRecordData);
                    $('#viewDlRecord').modal('show');
                })
            });
            // End of Fetch SSN Record by ID

            //Apply DataTable on Ssn Records table
            $('#dl_records_table').DataTable();
        });
    </script>
@endsection
