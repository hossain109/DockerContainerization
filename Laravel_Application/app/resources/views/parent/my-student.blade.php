@extends('layout.app')

@section('content')

<div class="content-wrapper">
<h4 class="text-center">Parent Name: <span style="color: rgb(76, 76, 232)"> {{$parent->name}} </span></h4>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <h3 class="m-2">Parent Student List</h3>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h5>Parent student Search</h5>
          </div>

          <form action="" method="get">
            @csrf
            <div class="card-body">
              <div class="row">
                <div class="col-md-2">
                    <div class="form-group d-inline">
                      <label for="id">Student ID</label>
                      <input type="text" class="form-control" value="{{Request::get('id')}}" name="id" id="id" placeholder="Enter student ID">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group d-inline">
                      <label for="name">Student Last Name</label>
                      <input type="text" class="form-control" value="{{Request::get('name')}}" name="name" id="name" placeholder="Enter Last name">
                    </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group d-inline">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{Request::get('email')}}" placeholder="Enter email">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group d-inline">
                    <label for="mobile_number">Mobile Number</label>
                    <input type="text" class="form-control" name="mobile_number" id="mobile_number" value="{{Request::get('mobile_number')}}" placeholder="Enter Mobile Number">
                  </div>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary" style="margin-top: 33px">Search</button>
                    <a class="btn btn-success" href="{{route('mystudent.parent',$parent)}}" style="margin-top: 33px;">Clear</a>
                  </div>
            </div>
            </div>
          </form>
        </div>
        @include('flush.message')
        <div class="row">
          <div class="col-md-12">
            @if(!empty($students))        
            <div class="card">
              <div class="card-header">
                <h5>Student List</h5>
              </div>
              <div class="card-body p-0" style="overflow: auto;">
                <table class="table table-striped" >
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Student Pic</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>Parents Name</th>
                      <th>Created Date</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($students as $student)
                    <tr>
                      <td>{{$student->id}}</td>
                      <td>
                        <img src="{{url('upload/image/'.$student->profile_pic)}}" alt="student Pic" height="60px" width="50px">
                      </td>
                      <td>{{$student->name}}</td>
                      <td>{{$student->email}}</td>
                      <td>{{$student->parent_name}}</td>
                      <td>{{date('d-m-y',strtotime($student->created_at))}}</td>
                      @if (empty($student->parent_name))
                      <td style="min-width: 160px">
                        <a class="btn btn-primary btn-sm" href="{{route('parents.assign',[$student,$parent])}}">Add student to parents</a>
                      </td>
                      @else 
                      <td style="min-width: 160px">
                      <a class="btn btn-primary btn-sm disabled" href="#" >Already added to parents</a>
                    </td>
                      @endif
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            @endif
           
            <div class="card">
                <div class="card-header">
                  <h5>Parent Student List</h5>
                </div>
                <div class="card-body p-0" style="overflow: auto;">
                  <table class="table table-striped" >
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Student Pic</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Class Name</th>
                        <th>Parents Name</th>
                        <th>Created Date</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($mystudents as $student)
                      <tr>
                        <td>{{$student->id}}</td>
                        <td>
                          <img src="{{url('upload/image/'.$student->profile_pic)}}" alt="student Pic" height="60px" width="50px">
                        </td>
                        <td>{{$student->name}}</td>
                        <td>{{$student->email}}</td>
                        <td>{{ $student->class_name}}</td>
                        <td>{{$student->parent_name}}</td>
                        <td>{{date('d-m-y',strtotime($student->created_at))}}</td>
                        <td style="min-width: 160px">
                          <a class="btn btn-danger btn-sm" href="{{route('parentsstudent.delete',[$student])}}">Delete</a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
             
          </div>
        </div>
      </div>
    </section>

  </div>
    </div>
  </section>

@endsection