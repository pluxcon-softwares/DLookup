@extends('admin.layouts.master')

@section('content')

<div class="col-md-12">

    <h3 style="padding: 10px 0 20px 0;">{{$title}}</h3>

    @if(Session::has('flash_message'))
        <div class="alert alert-primary" role="alert">
            {{Session::get('flash_message')}}
        </div>
    @endif
</div>

<div class="col-md-12">
    <table class="table" id="ssn_records_table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Fullname</th>
            <th scope="col">DOB</th>
            <th scope="col">SSN</th>
            <th scope="col">Gender</th>
            <th scope="col">State</th>
            <th scope="col">Address</th>
            <th scope="col">Details</th>
          </tr>
        </thead>
        <tbody>
            @if(count($ssn_records) > 0)
                @foreach($ssn_records as $ssn_record)
                <tr>
                    <th scope="row">{{$ssn_record->id}}</th>
                    <td>{{ $ssn_record->first_name }} {{ $ssn_record->last_name }}</td>
                    <td>{{ $ssn_record->dob }}</td>
                    <td>{{ $ssn_record->ssn }}</td>
                    <td>{{ $ssn_record->gender ? 'Female' : 'Male' }}</td>
                    <td>{{ $ssn_record->state->state }}</td>
                    <td>{{ $ssn_record->address}}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-primary view_ssn_record"
                        data-view_ssn_record="{{$ssn_record->id}}">View</a>
                        <a href="{{route('admin.ssn.edit', ['ssn_id' => $ssn_record->id])}}" class="btn btn-sm btn-info">Edit</a>
                        <a href="{{route('admin.ssn.delete', ['ssn_id'=>$ssn_record->id])}}" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                  </tr>
                @endforeach
            @endif
        </tbody>
      </table>

</div>

<div class="row">
<!-- Modal -->
<div class="modal fade" id="viewSsnRecord" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">SSN Record</h5>
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
            $('a.view_ssn_record').on('click', function(evt){
                var ssn_record_id = evt.currentTarget.dataset['view_ssn_record'];
                $.ajax({
                    url: '/admin/ssn/record/'+ ssn_record_id,
                    method: 'GET',
                }).then(function(res){
                    console.log(res.data);
                    var ssnRecordData = `
                    <h6>Full Name: ${res.data.first_name} ${res.data.middle_name ? res.data.middle_name : ''} ${res.data.last_name}</h6>
                    <p>DOB: ${res.data.dob}</p>
                    <p>Gender: ${res.data.gender ? 'Female' : 'Male'}</p>
                    <p>SSN: ${res.data.ssn}</p>
                    <p>State: ${res.data.state.state}</p>
                    <p>City: ${res.data.city}</p>
                    <p>Zip: ${res.data.zip}</p>
                    <p>Phone: ${res.data.phone ? res.data.phone : 'N/A'}</p>
                    <p>Email: ${res.data.email ? res.data.email : 'N/A'}</p>
                    `;
                    $('#viewSsnRecord .modal-body').empty();
                    $('#viewSsnRecord .modal-body').append(ssnRecordData);
                    $('#viewSsnRecord').modal('show');
                })
            });
            // End of Fetch SSN Record by ID

            //Apply DataTable on Ssn Records table
            $('#ssn_records_table').DataTable();
        });
    </script>
@endsection
