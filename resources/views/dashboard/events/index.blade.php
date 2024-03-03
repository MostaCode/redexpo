@extends('dashboard.master')

@section('content')

 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Events</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{route('events.create')}}" class="btn btn-primary">Create Event</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            @foreach ($events as $event)
                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column event-card">
                              <div class="card bg-light d-flex flex-fill">
                                <div class="card-header text-muted border-bottom-0">

                                  </div>
                                  <a href="{{route('events.show', $event->id)}}">
                                <div class="card-body pt-0">
                                  <div class="row">
                                    <div class="col-7">
                                      <h2 class="lead"><b>{{$event->title}}</b></h2>

                                      <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-map"></i></span>{{$event->location}}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-clock"></i></span> Start Date: {{$event->start_date}}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-clock"></i></span> End Date: {{$event->end_date}}</li>
                                      </ul>
                                    </div>
                                    <div class="col-5 text-center">
                                        @if ($event->thumbnail)
                                            <img src='{{asset("uploads/events/$event->thumbnail")}}' class="img-fluid">
                                            @else
                                            <img src='{{asset("images/event-placeholder.jpg")}}' class="img-fluid">
                                        @endif
                                    </div>
                                  </div>
                                </div>
                            </a>
                                <div class="card-footer">
                                  <div class="text-right">
                                    <a class="btn btn-sm btn-info" href="{{route('events.edit', $event->id)}}"><i class="fa fa-edit"></i> Edit</a>
                                    <a class="btn btn-sm btn-warning" href="{{route('events.show', $event->id)}}"><i class="fa fa-eye"></i> View</a>
                                    <a class="btn btn-sm btn-danger" href="{{route('delete_event', $event->id)}}"><i class="fa fa-trash"></i> Delete</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- /.card-body -->
                  </div>
              <!-- /.card -->
            </div>
          </div>
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->

@endsection
