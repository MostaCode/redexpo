@extends('dashboard.master')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-body row">
          <div class="col-5 text-center d-flex align-items-center justify-content-center">
            <div class="">
                <img src="data:image/png;base64, {{$qrcode}}" alt="">
              <p class="lead mb-1">#{{$invitation->invitation_number}}<br>
                Phone: {{$invitation->phone}}
              </p>
              <a href="{{asset("uploads/invitations/$invitation->invitation_number.pdf")}}" class="btn btn-primary mb-2"><i class="fas fa fa-file-pdf"></i> Download PDF</a>
            </div>
          </div>
          <div class="col-7">
            <form id="change-status" action="{{route('change_status')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Invitation Status</label>
                    <select id="invite_status" name="status" class="form-control select2" style="width: 100%;">
                        <option @if($invitation->status == 'Not checked in') selected @endif  value="Not checked in">Not checked in</option>
                        <option @if($invitation->status == 'Checked in') selected @endif value="Checked in">Checked in</option>
                        <option @if($invitation->status == 'Canceled') selected @endif value="Canceled">Canceled</option>
                    </select>
                    <input type="hidden" name="invitation_id" value="{{$invitation->id}}">
                  </div>
            </form>
            <h2>Access Logs</h2>
            <table id="access_table" class="table table-bordered table-striped align-middle">
                <thead>
                    <th>status</th>
                    <th>time</th>
                </thead>
            </table>
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->

@endsection


@section('scripts')

<script>
    $('#invite_status').change(function() {
        $('#change-status').submit();
    });
</script>

@endsection
