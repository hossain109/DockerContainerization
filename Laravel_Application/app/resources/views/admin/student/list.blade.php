@extends('layout.app')

@section('content')

<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <h3 class="m-2">Student List(<small>Total:{{$students->count()}}</small>)</h3>
          </div>
          <div class="col-md-6 text-right">
            <a href="{{url('admin/student/add')}}" class="btn btn-primary m-2">Add Student</a>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h5>Student Search</h5>
          </div>
          <form action="{{route('student.search')}}" method="post">
            @csrf
            <div class="card-body">
              <div class="row">
                <div class="col-md-2">
                    <div class="form-group d-inline">
                      <label for="name">Student Name</label>
                      <input type="text" class="form-control" value="{{Request::get('name')}}" name="name" id="name" placeholder="Enter name">
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
                    <label for="date">Date</label>
                    <input type="date" class="form-control" name="date" id="date" value="{{Request::get('date')}}" placeholder="Enter Date">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group d-inline">
                    <label for="roll_number">Roll Numbmer</label>
                    <input type="text" class="form-control" name="roll_number" id="roll_number" value="{{Request::get('roll_number')}}" placeholder="Enter roll number">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group d-inline">
                    <label for="admission_number">Admission Number</label>
                    <input type="text" class="form-control" name="admission_number" id="admission_number" value="{{Request::get('admission_number')}}" placeholder="Enter admission number">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group d-inline">
                    <label for="class_name">Class</label>
                    <input type="text" class="form-control" name="class_name" id="class_name" value="{{Request::get('class_name')}}" placeholder="Enter class name">
                  </div>
                </div>
                <div class="col-md-2">
                  <button class="btn btn-primary" style="margin-top: 33px">Search</button>
                  <a class="btn btn-success" href="{{url('admin/student/list')}}" style="margin-top: 33px;">Clear</a>
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
                <h5>Student List</h5>
              </div>
              <div class="card-body p-0" style="overflow: auto;">
                <table class="table table-striped" >
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Student Pic</th>
                      <th>Name</th>
                      <th>First Name</th>
                      <th>Parents Name</th>
                      <th>Admission Number</th>
                      <th>Roll Number</th>
                      <th>Class</th>
                      <th>Gender</th>
                      <th>Date of Birth</th>
                      <th>Status</th>
                      <th>Mobile Number</th>
                      <th>Admission Date</th>
                      <th>Blood Group</th>
                      <th>Height</th>
                      <th>Weith</th>
                      <th>Email</th>
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
                      <td>{{$student->first_name}}</td>
                      <td>{{$student->parent_name}}</td>
                      <td>{{$student->admission_number}}</td>
                      <td>{{$student->roll_number}}</td>
                      <td>{{$student->class_name}}</td>
                      <td>{{$student->gender}}</td>
                      <td>{{$student->birth_date}}</td>
                      <td>{{$student->status}}</td>
                      <td>{{$student->mobile_number}}</td>
                      <td>{{$student->admission_date}}</td>
                      <td>{{$student->blood_group}}</td>
                      <td>{{$student->height}}</td>
                      <td>{{$student->weight}}</td>
                      <td>{{$student->email}}</td>
                      <td>{{date('d-m-y',strtotime($student->created_at))}}</td>
                      <td style="min-width: 160px">
                        <a class="btn btn-primary btn-sm" href="{{route('student.modify',$student)}}">Modify</a>
                        <form action="{{route('student.delete',$student)}}" method="post" class="d-inline">
                          @csrf
                          <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            {{ $students->links() }}
          </div>
        </div>
      </div>
    </section>

  </div>
    </div>
  </section>

@endsection