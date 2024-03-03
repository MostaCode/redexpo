@extends('dashboard.master')

@section('content')

 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Companies</h1>
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
                        <a href="{{route('companies.create')}}" class="btn btn-primary">Create Company</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="companies" class="table table-bordered table-striped align-middle">
                        <thead>
                        <tr>
                          <th style="width:10%">#</th>
                          <th>Logo</th>
                          <th>Name</th>
                          <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($companies as $company)
                        <tr>
                          <td style="width:10%">{{$company->id}}</td>
                          <td><img style="height: 50px" src="{{asset('uploads/' . $company->logo)}}" alt=""></td>
                          <td><a href="{{route('companies.show', $company->id)}}">{{$company->name}}</a></td>
                          <td style="width:20%">
                            <a class="btn btn-sm btn-info" href="{{route('companies.edit', $company->id)}}"><i class="fa fa-edit"></i> Edit</a>
                            <a class="btn btn-sm btn-warning" href="{{route('companies.show', $company->id)}}"><i class="fa fa-eye"></i> View</a>
                            <a class="btn btn-sm btn-danger" href="{{route('delete_company', $company->id)}}"><i class="fa fa-trash"></i> Delete</a>
                            <a class="btn btn-sm btn-dark" href="{{route('companies.show', $company->id)}}"><i class="fa fa-user"></i> Agents</a>

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
