@extends('layout.app')

@section('content')

<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <h3 class="m-2">Parent List(<small>Total:{{$parents->count()}}</small>)</h3>
          </div>
          <div class="col-md-6 text-right">
            <a href="{{url('admin/parent/add')}}" class="btn btn-primary m-2">Add Parent</a>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h5>Parent Search</h5>
          </div>
          <form action="{{route('parent.search')}}" method="post">
            @csrf
            <div class="card-body">
              <div class="row">
                <div class="col-md-2">
                    <div class="form-group d-inline">
                      <label for="name">Parent Last Name</label>
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
                  <div class="form-group d-inline">
                    <label for="occupation">Occupation</label>
                    <input type="text" class="form-control" name="occupation" id="occupation" value="{{Request::get('occupation')}}" placeholder="Enter occupation">
                  </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group d-inline">
                      <label for="address">Address</label>
                      <input type="text" class="form-control" name="address" id="address" value="{{Request::get('address')}}" placeholder="Enter address">
                    </div>
                  </div>
                <div class="col-md-2">
                  <button class="btn btn-primary" style="margin-top: 33px">Search</button>
                  <a class="btn btn-success" href="{{url('admin/parent/list')}}" style="margin-top: 33px;">Clear</a>
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
                      <th>Parent Pic</th>
                      <th>Last Name</th>
                      <th>First Name</th>
                      <th>Gender</th>
                      <th>Phone Number</th>
                      <th>Occupation</th>
                      <th>Address</th>
                      <th>Status</th>
                      <th>Email</th>
                      <th>Created Date</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($parents as $parent)
                    <tr>
                      <td>{{$parent->id}}</td>
                      <td>
                        <img src="{{url('upload/image/'.$parent->profile_pic)}}" alt="parent Pic" height="60px" width="50px">
                      </td>
                      <td>{{$parent->name}}</td>
                      <td>{{$parent->first_name}}</td>
                      <td>{{$parent->gender}}</td>
                      <td>{{$parent->mobile_number}}</td>
                      <td>{{$parent->occupation}}</td>
                      <td>{{$parent->address}}</td>
                      <td>{{$parent->status?'active':'inactive'}}</td>
                      <td>{{$parent->email}}</td>
                      <td>{{date('d-m-y',strtotime($parent->created_at))}}</td>
                      <td style="min-width: 160px">
                        <a class="btn btn-primary btn-sm" href="{{route('parent.modify',$parent)}}">Modify</a>
                        <form action="{{route('parent.delete',$parent)}}" method="post" class="d-inline">
                          @csrf
                          <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                        <a href="{{route('mystudent.parent',$parent)}}" class="btn btn-primary btn-sm">My students</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            {{-- {{ $parents->links() }} --}}
          </div>
        </div>
      </div>
    </section>

  </div>
    </div>
  </section>

@endsection