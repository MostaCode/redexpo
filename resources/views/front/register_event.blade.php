<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{$event->title}} | RedExpo</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('/dist/css/custom.css')}}">
  <link rel="icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon" sizes="256x256"/>

</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
        <img src="{{asset('images/logo.png')}}" alt="RedExpo" style="height: 80px">
    </div>
    <div class="card-body">
        <div class="card card-primary">
            <!-- /.card-header -->
            <div class="card card-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <img style="width:100%" src="{{asset("uploads/events/$event->thumbnail")}}" alt="">
                <div class="card-footer">
                  <div class="row">
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header">{{$event->location}}</h5>
                        <span class="description-text">Location</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header">{{$event->start_date}}</h5>
                        <span class="description-text">Start Date</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4">
                      <div class="description-block">
                        <h5 class="description-header">{{$event->end_date}}</h5>
                        <span class="description-text">End Date</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
              </div>
          </div>
          <br>
      {{-- <p class="login-box-msg">Sign in to start your session</p> --}}
      <form action="{{route('invitations.store')}}" method="post">
        @csrf
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
        @endif

        <div class="input-group mb-3">
          <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Phone">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
          @error('phone')
          <div class="invalid-feedback">
            {{$error}}
          </div>
          @enderror

          <input type="hidden" name="agent" value="{{request()->get('ref')}}">
          <input type="hidden" name="event_id" value="{{$event->id}}">

        </div>
        <div class="row">
            <button type="submit" class="btn btn-primary btn-block">Register Invitation</button>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.card-body -->

  </div>
  <!-- /.card -->
  <p class="login-box-msg" style="    background: #000;color: #fff;padding: 10px;">Powered by 360 Tickets</p>

</div>
<!-- /.login-box -->


<!-- jQuery -->
<script src="{{asset('/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src=".{{asset('dist/js/adminlte.min.js')}}"></script>
</body>

<style>
    body {
        background: url({{asset('images/pattern.jpg')}});
    }
    .card-header.text-center {
    padding: 30px 0px 30px 0px;
}
</style>
</html>
