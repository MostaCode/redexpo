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
                  <h3 class="card-title">Edit {{$user->name}}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('users.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                  <div class="card-body">
                    <div class="card card-dark" style="border: 0">
                        <div class="card-body">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input name="name" type="text" class="form-control" id="name" placeholder="Enter User Name" value="{{$user->name}}">
                    </div>
                    <div class="form-group">
                        <label for="logo">Avatar</label>
                        <div class="custom-file">
                            <input type="file" name="avatar" class="custom-file-input" id="logo">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                          </div>
                          <img style="height: 40px" src="{{asset("uploads/$user->avatar")}}" alt="">
                      </div>
                      <div class="form-group">
                        <label for="phone">Phone</label>
                        <input name="phone" type="text" class="form-control" id="phone" placeholder="Enter User Phone Number" value="{{$user->phone}}">
                      </div>
                      <div class="form-group">
                        <label>Role</label>
                        <select name="role" class="form-control select2" style="width: 100%;">
                          @foreach ($roles as $role)
                            <option @if($user->roles()->pluck('name')[0] == $role->name) selected @endif value="{{$role->name}}">{{$role->display_name}}</option>
                          @endforeach
                        </select>
                      </div>

                    <div class="card card-dark" style="border: 0">
                        <div class="card-header">
                        <h3 class="card-title">Login Details</h3>
                        </div>
                        <div class="card-body">
                    <div class="form-group">
                        <label for="name">Username</label>
                        <input disabled type="text" name="username" class="form-control" id="name" placeholder="Enter Username" value="{{$user->username}}">
                      </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                    </div>
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
