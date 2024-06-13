@extends('layout.app')

@section('content')

<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            {{-- <h3 class="m-2">Teacher List(<small>Total:{{$teachers->count()}}</small>)</h3> --}}
          </div>
          <div class="col-md-6 text-right">
            <a href="{{url('admin/teacher/add')}}" class="btn btn-primary m-2">Add teacher</a>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h5>Teacher Search</h5>
          </div>
          <form action="{{route('teacher.search')}}" method="post">
            @csrf
            <div class="card-body">
              <div class="row">
                <div class="col-md-2">
                    <div class="form-group d-inline">
                      <label for="name">Teacher Name</label>
                      <input type="text" class="form-control" value="{{Request::get('name')}}" name="name" id="name" placeholder="Enter teacher name">
                    </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group d-inline">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{Request::get('email')}}" placeholder="Enter teacher email">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group d-inline">
                    <label for="mobile_number">Mobile Number</label>
                    <input type="number" class="form-control" name="mobile_number" id="mobile_number" value="{{Request::get('mobile_number')}}" placeholder="Enter mobile number">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group d-inline">
                    <label for="joining_date">Joigning Date</label>
                    <input type="date" class="form-control" name="joining_date" id="joining_date" value="{{Request::get('joining_date')}}" placeholder="Enter joining date">
                  </div>
                </div>
                <div class="col-md-2">
                  <button class="btn btn-primary" style="margin-top: 33px">Search</button>
                  <a class="btn btn-success" href="{{url('admin/teacher/list')}}" style="margin-top: 33px;">Clear</a>
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
                <h5>Teacher List</h5>
              </div>
              <div class="card-body p-0" style="overflow: auto;">
                <table class="table table-striped" >
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Teacher Pic</th>
                      <th>Name</th>
                      <th>First Name</th>
                      <th>Marital Status</th>
                      <th>Gender</th>
                      <th>Date of Birth</th>
                      <th>Mobile Number</th>
                      <th>Qualification</th>
                      <th>Joinging Date</th>
                      <th>Status</th>
                      <th>Permanent Address</th>
                      <th>Current Address</th>
                      <th>Work Experience</th>
                      <th>Note</th>
                      <th>Email</th>
                      <th>Created Date</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
        
                    @foreach ($teachers as $teacher)
                    <tr>
                      <td>{{$teacher->id}}</td>
                      <td>
                        <img src="{{url('upload/image/'.$teacher->profile_pic)}}" alt="teacher Pic" height="60px" width="50px">
                      </td>
                      <td>{{$teacher->name}}</td>
                      <td>{{$teacher->first_name}}</td>
                      <td>{{$teacher->marital_status}}</td>
                      <td>{{$teacher->gender}}</td>
                      <td>{{date('d-m-y',strtotime($teacher->birth_date))}}</td>
                      <td>{{$teacher->mobile_number}}</td>
                      <td>{{$teacher->qualification}}</td>
                      <td>{{date('d-m-y',strtotime($teacher->joining_date))}}</td>
                      <td>{{ $teacher->status?'Active':'Inactvie' }}</td>
                      <td>{{$teacher->permanent_adress}}</td>
                      <td>{{$teacher->address}}</td>
                      <td>{{$teacher->work_experience}}</td>
                      <td>{{$teacher->note}}</td>
                      <td>{{$teacher->email}}</td>
                      <td>{{date('d-m-y',strtotime($teacher->created_at))}}</td>
                      <td style="min-width: 160px">
                        <a class="btn btn-primary btn-sm" href="{{route('teacher.modify',$teacher)}}">Modify</a>
                        <form action="{{route('teacher.delete',$teacher)}}" method="post" class="d-inline">
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
            {{-- {{ $teachers->links() }} --}}
          </div>
        </div>
      </div>
    </section>

  </div>
    </div>
  </section>

@endsection