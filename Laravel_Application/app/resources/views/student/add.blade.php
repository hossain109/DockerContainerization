@extends('layout.app')

@section('content')
<div class="content-wrapper">
    @include('flush.message')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Change Password </h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <form action="" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="current">Current Password</label>
                        <input type="password" class="form-control" value="" name="current" id="current" placeholder="Enter current password">
                    </div>
                  <div class="form-group">
                    <label for="new">New password</label>
                    <input type="password" class="form-control" name="new" id="new" value="" placeholder="Enter New password">
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
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