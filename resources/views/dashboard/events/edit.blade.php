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

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit {{$event->title}}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('events.update', $event->id)}}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                  <div class="card-body">
                    <div class="card card-dark" style="border: 0">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input name="title" type="text" class="form-control" id="title" value="{{$event->title}}">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_date">Start Date</label>
                                        <input name="start_date" type="text" class="form-control flatpickr" id="start_date" value="{{$event->start_date}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_date">End Date</label>
                                        <input name="end_date" type="text" class="form-control flatpickr" id="end_date" value="{{$event->end_date}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input name="location" type="text" class="form-control" id="location" value="{{$event->location}}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control summernote">{!! $event->description !!}</textarea>
                            </div>
                    <div class="form-group">
                        <label for="thumbnail">Thumbnail</label>
                        <div class="custom-file">
                            <input type="file" name="thumbnail" class="custom-file-input" id="thumbnail">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                          </div>
                          <img style="height: 80px" src='{{asset("uploads/events/$event->thumbnail")}}'>
                      </div>
                    <div class="form-group">
                        <label for="gallery">Gallery (Optional)</label>
                        <div class="custom-file">
                            <input type="file" name="gallery" multiple class="custom-file-input" id="gallery">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                          </div>
                      </div>

                    </div>
                  </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->


            </div>
            <!--/.col (right) -->
          </div>

      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->

@endsection
