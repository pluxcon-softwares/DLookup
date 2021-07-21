@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-1-12 mt-5">
        <h3>{{$title}}</h3>
    </div>
</div>

@if(session('flash_message'))
<div class="row mt-5">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">
            {{ session('flash_message') }}
          </div>
    </div>
</div>
@endif

<div class="row">
    <div class="col-4 mt-5">
        <form action="{{ route('user.ticket.create') }}" method="POST">
            @csrf
            <div class="form-group">
              <input type="text" name="title" class="form-control" placeholder="{{__('Title')}}" aria-describedby="titleHelpId">
              <small id="titleHelpId" style="color: red; font-size:12px;">{{ $errors->first('title') }}</small>
            </div>

            <div class="form-group">
              <textarea name="body" rows="8" cols="4" class="form-control" placeholder="{{__('Content')}}" aria-describedby="bodyHelpId"></textarea>
              <small id="bodyHelpId" style="color: red; font-size:12px;">{{$errors->first('body')}}</small>
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-sm">{{__('Add Ticket')}}</button>
        </form>
    </div>

    <div class="col-8">
        <table class="table table-primary table-responsive" id="ticketsTable">
            <thead class="thead-dark">
              <tr>
                <th scope="col" style="width: 250px">{{__('Ticket')}}</th>
                <th scope="col" style="width: 100px">{{__('Created Date')}}</th>
                <th scope="col">{{__('Status')}}</th>
                <th scope="col" style="width: 50px">{{__('Reply')}}</th>
                <th scope="col">{{__('Action')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->title }}</td>
                    <td>{{ $ticket->created_at->diffForHumans() }}</td>
                    <td>
                        @if($ticket->is_replied == 1)
                        <span class="badge badge-pill badge-primary">Resolved</span>
                        @else
                        <span class="badge badge-pill badge-danger">Unresolved</span>
                        @endif
                    </td>
                    <td>
                        @if($ticket->is_replied == 1)
                            <a href="#" class="btn btn-sm btn-primary viewTicketTeply" data-view_ticket_reply="{{$ticket->id}}">{{__('View')}}</a>
                        @endif
                    </td>
                    <td>
                        <form action="{{route('user.ticket.delete')}}" method="POST">
                            @csrf
                            <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                            <button type="submit" class="btn btn-sm btn-danger">{{__('Delete')}}</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
    </div>
</div>

<div class="row">
    <!-- Modal -->
<div class="modal fade" id="viewTicketReply" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Support/Ticket Reply</h5>
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
    $(document).ready(function(){
        $("#ticketsTable").DataTable();
    });

    //VIew Ticket Reply
    $('a.viewTicketTeply').on('click', function(evt){
        evt.preventDefault();
        var ticket_id = evt.currentTarget.dataset['view_ticket_reply'];
        $.ajax({
            url: '/dashboard/ticket/reply/'+ticket_id,
            success: function(res){
                $('#viewTicketReply .modal-body').empty();
                var reply = `
                <p>${res.reply}</p>
                `;
                $('#viewTicketReply .modal-body').append(reply);
                $('#viewTicketReply').modal('show');
            }
        });
    });
</script>
@endsection
