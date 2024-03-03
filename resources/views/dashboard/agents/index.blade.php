@extends('dashboard.master')

@section('content')

 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Agents</h1>
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
                        <a href="{{route('agents.create')}}" class="btn btn-primary">Create Agent</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="agents" class="table table-bordered table-striped align-middle">
                        <thead>
                        <tr>
                          <th style="width:10%">#</th>
                          <th>Name</th>
                          <th>Company</th>
                          <th>Phone</th>
                          <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($agents as $agent)
                        <tr>
                          <td style="width:10%">{{$agent->id}}</td>
                          <td>{{$agent->name}}</td>
                          <td>{{$agent->company->name}}</td>
                          <td>{{$agent->phone}}</td>
                          <td>
                            <a class="btn btn-small btn-info" href="{{route('agents.edit', $agent->id)}}"><i class="fa fa-edit"></i> Edit</a>
                            <a class="btn btn-small btn-warning" href="{{route('agents.show', $agent->id)}}"><i class="fa fa-eye"></i> View</a>
                            <a class="btn btn-small btn-danger" href="{{route('delete_agent', $agent->id)}}"><i class="fa fa-trash"></i> Delete</a>
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
