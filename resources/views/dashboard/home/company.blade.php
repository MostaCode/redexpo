@extends('dashboard.master')

@section('content')

 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Welcome to RedExpo System</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
        <div class="row">
            @role('superadmin')
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-dark">
                <div class="inner">
                  <h3>{{$companies_count}}</h3>
                  <p>Company</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="{{route('companies.index')}}" class="small-box-footer">Browse Companies <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            @endrole
            <!-- ./col -->
            @role('company')
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-dark">
                <div class="inner">
                  <h3>{{$agents_count}}</h3>
                  <p>Agents</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-dark"></i>
                </div>
                <a href="{{route('agents.index')}}" class="small-box-footer">Browse Agents <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            @endrole
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-dark">
                <div class="inner">
                  <h3>{{$clients_count}}</h3>

                  <p>Clients</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="{{route('clients.index')}}" class="small-box-footer">Browse Clients <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-dark">
                <div class="inner">
                  <h3>{{$events_count}}</h3>
                  <p>Events</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{route('events.index')}}" class="small-box-footer">Show Events <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          @role('superadmin')
          <div class="row">
            <h3>Events Reports</h3>
            <div class="col-md-12">
            <!-- Widget: user widget style 1 -->
            @foreach ($events as $event)
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-dark">
                <h3 class="widget-user-username">{{$event->title}}</h3>
                <h5 class="widget-user-desc">{{$event->location}}</h5>
              </div>
              <div class="widget-user-image">
                @if ($event->thumbnail)
                <img src='{{asset("uploads/events/$event->thumbnail")}}' class="img-circle">
                @else
                <img src='{{asset("images/event-placeholder.jpg")}}' class="img-circle">
            @endif              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$event->invitations->count()}}</h5>
                      <span class="description-text">Attendance</span>
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
            @endforeach

            <!-- /.widget-user -->
          </div>
        </div>
@endrole
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->

@endsection
