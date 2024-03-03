@extends('dashboard.master')

@section('content')

 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Clients</h1>
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
                        <div class="row">
                            <div class="col-md-4">
                                <a href="{{route('clients.create')}}" class="btn btn-primary">Add Client</a>
                                <a href="{{asset('uploads/clients_import.xlsx')}}" class="btn btn-success">Download Example Excel File</a>
                            </div>
                            <div class="col-md-8">
                                <form action="{{ route('upload_clients') }}" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="row text-right" style="justify-content:end;padding-right:10px">
                                        <div class="col-md-2">
                                            <label style="margin-top:5px" for="">Import Clients: </label>
                                        </div>
                                    <div class="col-md-4">
                                        <input type="file" name="import" class="form-control" style="padding: 3px;" name="users" required />
                                    </div>

                                    @if(!auth()->user()->hasRole('agent'))
                                    <div class="col-md-1">
                                        <label style="margin-top:5px" for="">Agent: </label>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="agent_id" class="form-control select2" style="width: 100%;">
                                            @foreach ($agents as $agent)
                                              <option value="{{$agent->id}}">{{$agent->name}}</option>
                                            @endforeach
                                          </select>
                                    </div>
                                    @endrole
                                    @role('agent')
                                    <input type="hidden" value="{{auth()->user()->agent->id}}" name="agent_id">
                                    @endrole
                                    <div class="col-md-1">
                                        <button type="submit" class="btn btn-success" name="upload">Import</button>
                                    </div>
                                </div>

                                </form>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="companies" class="table table-bordered table-striped align-middle text-center">
                        <thead>
                        <tr>
                          <th style="width:10%">#</th>
                          <th>Phone Number</th>
                          <th>Agent</th>
                          <th>Created At</th>
                          <th style="width: 30%">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($clients as $client)
                        <tr>
                          <td>{{$client->id}}</td>
                          <td>{{$client->phone}}</td>
                          <td>{{$client->agent->name}}</td>
                          <td>{{$client->created_at}}</td>
                          <td style="width: 30%">
                            <a class="btn btn-small btn-info" href="{{route('clients.edit', $client->id)}}"><i class="fa fa-edit"></i> Edit</a>
                            <a class="btn btn-small btn-success" href="{{route('clients.edit', $client->id)}}"><i class="fab fa-whatsapp"></i> Send</a>
                            <a class="btn btn-small btn-danger" href="{{route('delete_client', $client->id)}}"><i class="fa fa-trash"></i> Delete</a>

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
