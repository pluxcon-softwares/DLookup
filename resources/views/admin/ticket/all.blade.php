@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-12 mt-5 mb-3">
            <h4>{{$title}}</h4>
        </div>

        @if(session('flash_message'))
        <div class="row mt-5 mb-3">
            <div class="col-md-12">
                <div class="alert alert-success" role="alert">
                    {{ session('flash_message') }}
                </div>
            </div>
        </div>
        @endif

        <div class="col-12">
            <table class="table table-dark" id="ticketsTable">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Ticket</th>
                    <th scope="col" style="width: 50px;">Status</th>
                    <th scope="col" style="width: 150px;">Created Date</th>
                    <th scope="col" style="width: 50px;">Action</th>
                    <th scope="col" style="width: 50px;">&nbsp;</th>
                    <th scope="col" style="width: 50px;">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->title }}</td>
                        <td>
                            @if($ticket->is_replied == 1)
                            <span class="badge badge-pill badge-primary">Resolved</span>
                            @else
                            <span class="badge badge-pill badge-danger">Unresolved</span>
                            @endif
                        </td>
                        <td>{{ $ticket->created_at->diffForHumans() }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-primary viewTicket" data-view_ticket="{{$ticket->id}}">View</a>
                        </td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info replyTicket" data-reply_ticket="{{$ticket->id}}">Reply</a>
                        </td>
                        <td>
                            <form action="{{route('admin.delete.ticket')}}" method="POST">
                                @csrf
                                <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>

    <!-- View Ticket Modal -->
    <div class="row">
        <!-- Modal -->
    <div class="modal fade" id="viewTicket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Support/Ticket</h5>
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
    <!-- .// View Ticket Modal -->


    <!-- Reply Ticket Modal -->
    <div class="row">
        <!-- Modal -->
    <div class="modal fade" id="replyTicket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Reply Ticket</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.reply.ticket')}}" id="replyFrm">
                    <div class="form-group">
                      <textarea id="replyTxt" rows="7" cols="4" class="form-control" placeholder="Content here"></textarea>
                      <small id="helpId" style="font-size: 12px; color:red"></small>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Reply</button>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- .// Reply Ticket Modal -->
@endsection


@section('extra_script')
<script>
    jQuery(document).ready(function($){

        //View Ticket
        function viewTicket(){
            $('a.viewTicket').on('click', function(evt){
                evt.preventDefault();
                var ticket_id = evt.currentTarget.dataset['view_ticket'];
                $('#viewTicket').modal('show');
                $.ajax({
                    url: '/admin/ticket/view/' + ticket_id,
                    method: 'GET',
                    success: function(res){
                        $('#viewTicket .modal-body').empty();
                        var ticket_data = `
                        <h5>Subject: ${res.title}</h5>
                        <p>Content: ${res.body}</p>
                        <span>User: ${res.user.username}</span>
                        `;
                        $('#viewTicket .modal-body').append(ticket_data);
                        $('#viewTicket').modal('show');
                        //console.log(res.user)
                    }
                });
            });
        }
        viewTicket();
        // end of view ticket

        //Reply Ticket
        function replyTicket()
        {
            $('a.replyTicket').on('click', function(evt){
                evt.preventDefault();
                $('#replyTicket').modal('show');
                $('#replyFrm').submit(function(e){
                    e.preventDefault();
                    $.ajax({
                        url: '/admin/ticket/reply',
                        method: 'POST',
                        data:{
                            _token: "{{csrf_token()}}",
                            ticket_id: evt.currentTarget.dataset['reply_ticket'],
                            reply: $('#replyTxt').val()
                        },
                        success: function(res){
                            if(res.success === true)
                            {
                                $('#replyTicket').modal('hide');
                                window.location.reload();
                            }
                            if(res.error == true)
                            {
                                console.log(res.error_msg)
                                $('small#helpId').text(res.error_msg.reply);
                            }
                        }
                    });
                });
            });
        }
        replyTicket();
        //end reply ticket
    });
</script>
@endsection


@section('extra_script')
    <script>
        $(document).ready(function(){
            $('#ticketsTable').DataTable();
        });
    </script>
@endsection
