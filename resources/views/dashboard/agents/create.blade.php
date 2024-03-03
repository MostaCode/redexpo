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
                  <h3 class="card-title">Create Agent</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('agents.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                  <div class="card-body">
                    <div class="card card-dark" style="border: 0">
                        <div class="card-header">
                        <h3 class="card-title">Agent Details</h3>
                        </div>
                        <div class="card-body">
                            @role('superadmin')
                            <div class="form-group">
                                <label>Company</label>
                                <select name="company_id" class="form-control select2" style="width: 100%;">
                                  @foreach ($companies as $company)
                                    <option value="{{$company->id}}">{{$company->name}}</option>
                                  @endforeach
                                </select>
                              </div>
                              @endrole
                              @role('company')
                                <input type="hidden" name="company_id" value="{{auth()->user()->company->id}}">
                              @endrole
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input name="name" type="text" class="form-control" id="name" placeholder="Enter Agent Name">
                    </div>
                    <div class="form-group">
                        <label for="logo">Logo</label>
                        <div class="custom-file">
                            <input type="file" name="logo" class="custom-file-input" id="logo">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                          </div>
                      </div>
                      <div class="form-group">
                        <label for="phone">Phone</label>
                        <input name="phone" type="text" class="form-control" id="phone" placeholder="Enter Agent Phone">
                      </div>

                    </div>
                  </div>
                    <div class="card card-dark" style="border: 0">
                        <div class="card-header">
                        <h3 class="card-title">Login Details</h3>
                        </div>
                        <div class="card-body">
                    <div class="form-group">
                        <label for="name">Username</label>
                        <input type="text" name="username" class="form-control" id="name" placeholder="Enter Username">
                      </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input name="password" type="password" class="form-control" id="password" placeholder="Password">
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
