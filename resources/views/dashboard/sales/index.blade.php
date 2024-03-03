@extends('dashboard.master')

@section('content')

 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Sales</h1>
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
                        <a href="{{route('sales.create')}}" class="btn btn-primary">Create Sales</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="sales" class="table table-bordered table-striped align-middle">
                        <thead>
                        <tr>
                          <th style="width:10%">#</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Agent</th>
                          <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($all_sales as $sales)
                        <tr>
                          <td style="width:10%">{{$sales->id}}</td>
                          <td>{{$sales->name}}</td>
                          <td>{{$sales->phone}}</td>
                          <td>{{$sales->agent->name}}</td>
                          <td>
                            <a class="btn btn-small btn-info" href="{{route('sales.edit', $sales->id)}}"><i class="fa fa-edit"></i> Edit</a>
                            <a class="btn btn-small btn-danger" href="{{route('delete_sales', $sales->id)}}"><i class="fa fa-trash"></i> Delete</a>
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
