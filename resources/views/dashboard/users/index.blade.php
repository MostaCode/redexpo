@extends('dashboard.master')

@section('content')

 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Users</h1>
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
                        <a href="{{route('users.create')}}" class="btn btn-primary">Create User</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="users" class="table table-bordered table-striped align-middle">
                        <thead>
                        <tr>
                          <th style="width:10%">#</th>
                          <th>Name</th>
                          <th>Role</th>
                          <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                        <tr>
                          <td style="width:10%">{{$user->id}}</td>
                          <td>{{$user->name}}</td>
                          <td>{{$user->roles()->pluck('display_name')[0]}}</td>
                          <td>
                            <a class="btn btn-small btn-info" href="{{route('users.edit', $user->id)}}"><i class="fa fa-edit"></i> Edit</a>
                            @if(!$user->hasRole('superadmin'))
                            <a class="btn btn-small btn-danger" href="{{route('delete_user', $user->id)}}"><i class="fa fa-trash"></i> Delete</a>
                            @endif
                        </td>
                        </tr>
                        @endforeach
                        </tfoot>
                      </table>
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
