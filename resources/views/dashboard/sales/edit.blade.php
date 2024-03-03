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
                  <h3 class="card-title">Edit {{$sales->name}}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('sales.update', $sales->id)}}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                  <div class="card-body">
                    <div class="card card-dark" style="border: 0">
                        <div class="card-header">
                        <h3 class="card-title">Sales Details</h3>
                        </div>
                        <div class="card-body">
                            @role('superadmin')
                            <div class="form-group">
                                <label>Agent</label>
                                <select name="agent_id" class="form-control select2" style="width: 100%;">
                                  @foreach ($agents as $agent)
                                    <option @if($agent->id == $sales->agent_id) selected @endif value="{{$agent->id}}">{{$agent->name}}</option>
                                  @endforeach
                                </select>
                              </div>
                              @endrole
                              @role('agent')
                                <input type="hidden" name="agent_id" value="{{auth()->user()->agent->id}}">
                              @endrole
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input name="name" type="text" class="form-control" id="name" placeholder="Enter Sales Name" value="{{$sales->name}}">
                    </div>
                      <div class="form-group">
                        <label for="phone">Phone</label>
                        <input name="phone" type="text" class="form-control" id="phone" placeholder="Enter Sales Phone" value="{{$sales->phone}}">
                      </div>
                      <div class="form-group">
                        <label for="avatar">Profile Pic</label>
                        <div class="custom-file">
                            <input type="file" name="avatar" class="custom-file-input" id="avatar">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                          </div>
                      </div>
                      <img style="height: 60px" src="{{asset("uploads/avatars/$sales->avatar")}}" alt="">
                    </div>
                  </div>
                    <div class="card card-dark" style="border: 0">
                        <div class="card-header">
                        <h3 class="card-title">Login Details</h3>
                        </div>
                        <div class="card-body">
                    <div class="form-group">
                        <label for="name">Username</label>
                        <input disabled type="text" name="username" class="form-control" id="name" placeholder="Enter Username" value="{{$sales->user->username}}">
                      </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input name="password" type="password" class="form-control" id="password" placeholder="Password" value="">
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
