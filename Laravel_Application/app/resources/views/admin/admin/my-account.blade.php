@extends('layout.app')

@section('content')
<div class="content-wrapper">
    @include('flush.message')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>My Account</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <div class="card card-primary">
              <form action="{{route('admin.account')}}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" value="{{old('name',$admin->name)}}" name="name" id="name" placeholder="Enter name">
                      </div>
                  <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{old('email',$admin->email)}}" placeholder="Enter email">
                    <div class="text-danger">{{$errors->first('email')}}</div>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update </button>
                </div>
              </form>
            </div>
        </div>
      </div>
    </section>
  </div>
@endsection