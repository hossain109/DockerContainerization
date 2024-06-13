@extends('layout.app')

@section('content')

<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <h3 class="m-2">Class List(<small>Total:{{ App\Models\Subject_assign_class::count() }}</small>)</h3>
          </div>
          <div class="col-md-6 text-right">
            <a href="{{url('admin/subject-class/add')}}" class="btn btn-primary m-2">Assign Subject Class</a>
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
                      <label for="class">Class Name</label>
                      <input type="text" class="form-control" value="{{Request::get('class')}}" name="class" id="class" placeholder="Enter class name">
                    </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group d-inline">
                    <label for="subject">Subject Name</label>
                    <input type="text" class="form-control" value="{{Request::get('subject')}}" name="subject" id="subject" placeholder="Enter subject name">
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
                  <a class="btn btn-success" href="{{url('admin/subject-class/list')}}" style="margin-top: 33px;">Clear</a>
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
                      <th>Class Name</th>
                      <th>Subject Name</th>
                      <th>Status</th>
                      <th>Created By</th>
                      <th>Created Date</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($subclasses as $subclass)
                   
                    <tr>
                      <td>{{$subclass->id}}</td>
                      <td>{{$subclass->classe->name}}</td>
                      <td>{{$subclass->subject->name}}</td>
                      <td>{{$subclass->status?'Active':'Not Active' }}</td>
                      <td>{{$subclass->createdBy}}</td>
                      <td>{{date('d-m-y',strtotime($subclass->created_at))}}</td>
                      <td>
                        <a class="btn btn-primary" href="{{route('subclass.modify',$subclass)}}">Modify</a>
                        <form action="{{route('subclass.delete',$subclass)}}" method="post" class="d-inline">
                          @csrf
                          <button class="btn btn-danger">Delete</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            {{ $subclasses->links() }}
          </div>
        </div>
      </div>
    </section>
  </div>
  </div>
  </section>

@endsection