@extends('layout.app')

@section('content')

<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <h3 class="m-2">Class List(<small>Total:{{ App\Models\Classe::count() }}</small>)</h3>
          </div>
          <div class="col-md-6 text-right">
            <a href="{{url('/admin/class/add')}}" class="btn btn-primary m-2">Add Class</a>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h5>Class Search</h5>
          </div>
          <form action="{{route('class.search')}}" method="post">
            @csrf
            <div class="card-body">
              <div class="row">
                <div class="col-md-3">
                    <div class="form-group d-inline">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" value="{{Request::get('name')}}" name="name" id="name" placeholder="Enter name">
                    </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group d-inline">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" name="date" id="date" value="{{Request::get('date')}}" placeholder="Enter Date">
                  </div>
                </div>
                <div class="col-md-3">
                  <button class="btn btn-primary" style="margin-top: 33px">Search</button>
                  <a class="btn btn-success" href="{{url('admin/class/list')}}" style="margin-top: 33px;">Clear</a>
                </div>
            </div>
            </div>
          </form>
        </div>
        @include('flush.message')
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5>Class List</h5>
              </div>
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Created By</th>
                      <th>Created Date</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($classes as $class)
                   
                    <tr>
                      <td>{{$class->id}}</td>
                      <td>{{$class->name}}</td>
                      <td>{{$class->status?'Active':'Not Active' }}</td>
                      <td>{{$class->createdBy}}</td>
                      <td>{{date('d-m-y',strtotime($class->created_at))}}</td>
                      <td>
                        <a class="btn btn-primary" href="{{route('class.modify',$class)}}">Modify</a>
                        <form action="{{route('class.delete',$class)}}" method="post" class="d-inline">
                          @csrf
                          <button class="btn btn-danger">Delete</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
     
              <!-- /.card-body -->
            </div>
            {{ $classes->links() }}
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>


      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
    </div><!-- /.container-fluid -->
  </section>

@endsection