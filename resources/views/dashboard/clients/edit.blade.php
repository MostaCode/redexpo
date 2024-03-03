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
                  <h3 class="card-title">Edit {{$client->phone}}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('clients.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                  <div class="card-body">
                    <div class="card card-dark" style="border: 0">
                        <div class="card-body">
                            @role('superadmin')
                            <div class="form-group">
                                <label>Agent</label>
                                <select name="agent_id" class="form-control select2" style="width: 100%;">
                                  @foreach ($agents as $agent)
                                    <option @if($client->agent_id == $agent->id) selected @endif value="{{$agent->id}}">{{$agent->name}}</option>
                                  @endforeach
                                </select>
                              </div>
                              @endrole
                      <div class="form-group">
                        <label for="phone">Phone</label>
                        <input name="phone" type="tel" value="{{$client->phone}}" class="form-control" id="phone" placeholder="Enter Client Phone">
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
