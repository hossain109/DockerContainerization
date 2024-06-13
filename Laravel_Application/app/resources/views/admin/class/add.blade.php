@extends('layout.app')

@section('content')
<div class="content-wrapper">
    @include('flush.message')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> @if($class->id)
                Modify Class
            @else
            Add new Class
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
              <form action="{{route($class->exists?'class.update':'class.store',$class)}}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" value="{{old('name',$class->name)}}" name="name" id="name" placeholder="Enter class name">
                      </div>
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1" {{ $class->status==1?'selected':'' }}>Active</option>
                        <option value="0" {{ $class->status==0?'selected':'' }}>Not Active</option>
                    </select>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">
                    @if ($class->id)
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