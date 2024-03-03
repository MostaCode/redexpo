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
                  <h3 class="card-title">Edit {{$company->name}}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('companies.update', $company->id)}}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                  <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <div class="card card-dark" style="border: 0">
                        <div class="card-header">
                        <h3 class="card-title">Company Details</h3>
                        </div>
                        <div class="card-body">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input name="name" type="text" class="form-control" id="name" placeholder="Enter Company Name" value="{{$company->name}}">
                    </div>
                    <div class="form-group">
                        <label for="logo">Logo</label>
                        <div class="custom-file">
                            <input type="file" name="logo" class="custom-file-input" id="logo">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                          </div>
                          <img style="height: 80px" src="{{asset('uploads/company/' . $company->logo)}}" alt="">

                      </div>
                    <div class="form-group">
                      <label for="name">About</label>
                     <textarea class="form-control" name="about">{{$company->about}}</textarea>
                    </div>
                    </div>
                  </div>
                    <div class="card card-dark" style="border: 0">
                        <div class="card-header">
                        <h3 class="card-title">Login Details</h3>
                        </div>
                        <div class="card-body">
                    <div class="form-group">
                      <label for="password">Change Password</label>
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
