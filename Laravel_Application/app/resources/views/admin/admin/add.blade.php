@extends('layout.app')

@section('content')
<div class="content-wrapper">
    @include('flush.message')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> @if($admin->id)
                Modify Admin
            @else
            Add new admin
            @endif </h1>
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
              <form action="{{route($admin->exists?'admin.update':'admin.store',$admin)}}" method="post">
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
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    @if ($admin->id)
                        <span class="text-danger"> Do you want to change password,please add new password</span>
                    @endif  
                </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">
                    @if ($admin->id)
                        Modify
                    @else
                        Add
                    @endif
                </button>
                </div>
              </form>
            </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection