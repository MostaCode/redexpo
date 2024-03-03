@extends('dashboard.master')

@section('content')

 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"></h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                @if ($event->thumbnail)
                <img class="profile-user-img img-fluid img-circle" src='{{asset("uploads/events/$event->thumbnail")}}' class="img-fluid">
                @else
                <img class="profile-user-img img-fluid img-circle" src='{{asset("images/event-placeholder.jpg")}}' class="img-fluid">
            @endif
              </div>

              <h3 class="profile-username text-center">{{$event->title}}</h3>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Location</b> <a class="float-right">{{$event->location}}</a>
                </li>
                <li class="list-group-item">
                  <b>Start Date</b> <a class="float-right">{{$event->start_date}}</a>
                </li>
                <li class="list-group-item">
                  <b>End Date</b> <a class="float-right">{{$event->end_date}}</a>
                </li>
              </ul>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <!-- About Me Box -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Invite Link</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <input disabled name="title" type="text" class="form-control" id="title" value="{{route('event_register', $event->slug)}}?ref={{auth()->user()->username}}">
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#invitations" data-toggle="tab">Invitations</a></li>
                <li class="nav-item"><a class="nav-link" href="#upload_clients" data-toggle="tab">Upload Invitations</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="invitations">
                        @if ($errors->has('phone') || session('error'))
                        <div class="alert alert-danger">
                        {{ $errors->first('phone') }}
                        {{session('error')}}
                    </div>
                        @endif
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                        @endif
                    <button style="margin-bottom: 10px" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-invitation">
                        Create Invitation
                      </button>
                      <table id="invitations_table" class="table table-bordered table-striped align-middle">
                        <thead>
                        <tr>
                          <th># Invitiation Number</th>
                          <th>Name</th>
                          <th>Agent</th>
                          <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($invitations as $invitation)
                        <tr>
                          <td>{{$invitation->invitation_number}}</td>
                          <td>{{$invitation->phone}}</td>
                          <td>{{$invitation->user->name}}</td>
                          <td>
                            <a class="btn btn-sm btn-warning" href="{{route('invitations.show', $invitation->id)}}"><i class="fa fa-eye"></i> View</a>
                            <a class="btn btn-sm btn-success" href="{{route('send_qr_whatsapp', $invitation->phone)}}"><i class="fab fa-whatsapp"></i> Send</a>
                            <a class="btn btn-sm btn-info" target="_blank" href="{{asset("uploads/invitations/$invitation->invitation_number.pdf")}}"><i class="fa fa-file-pdf"></i> Download Pdf</a>
                            <a class="btn btn-sm btn-danger" href="{{route('delete_invitation', $invitation->id)}}"><i class="fa fa-trash"></i> Delete</a>
                        </td>
                        </tr>
                        @endforeach
                      </table>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="upload_clients">
                    <a href="{{asset('uploads/clients_import.xlsx')}}" class="btn btn-dark mb-2">Download Example Excel File</a>
                    <div class="spinner" style="display:none"><img src="{{asset('images/spinner.gif')}}" alt="">Please Wait don't close this window</div>
                    <form action="{{ route('upload_invitations') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <br>
                        <label for="import">Import Phone Numbers</label>
                        <input type="file" name="import" class="form-control" style="padding: 3px;" required />
                        <input type="hidden" value="{{auth()->user()->id}}" name="agent_id">
                        <input type="hidden" value="{{$event->id}}" name="event_id">
                        <br>
                        <button type="submit" class="btn btn-success import-submit" name="upload_send">Import & Send</button>

                    </form>
                </div>
                <!-- /.tab-pane -->

                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>


  <div class="modal fade" id="modal-invitation">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Create Invitation</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('invitations.store')}}" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
                @csrf
              <div class="card-body">
                  <div class="form-group">
                    <label for="phone">Phone</label>
                    <input name="phone" type="tel" class="form-control" id="phone">
                  </div>
                  <input type="hidden" name="agent" value="{{auth()->user()->username}}">
                  <input type="hidden" name="event_id" value="{{$event->id}}">
              </div>
              <!-- /.card-body -->
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
@endsection


@section('scripts')

<script>
    $('.import-submit').click(function() {
        $('.spinner').show();
    });
</script>

@endsection
