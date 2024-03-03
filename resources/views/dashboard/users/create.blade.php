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
                  <h3 class="card-title">Create User</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                  <div class="card-body">
                    <div class="card card-dark" style="border: 0">
                        <div class="card-body">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input name="name" type="text" class="form-control" id="name" placeholder="Enter User Name">
                    </div>
                    <div class="form-group">
                        <label for="logo">Avatar</label>
                        <div class="custom-file">
                            <input type="file" name="avatar" class="custom-file-input" id="logo">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                          </div>
                      </div>
                      <div class="form-group">
                        <label for="phone">Phone</label>
                        <input name="phone" type="text" class="form-control" id="phone" placeholder="Enter User Phone Number">
                      </div>
                      <div class="form-group">
                        <label>Role</label>
                        <select name="role" class="form-control select2" style="width: 100%;">
                          @foreach ($roles as $role)
                            <option value="{{$role->name}}">{{$role->display_name}}</option>
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
                        <input type="text" name="username" class="form-control" id="name" placeholder="Enter Company Username">
                      </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" id="password" placeholder="Password">
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
