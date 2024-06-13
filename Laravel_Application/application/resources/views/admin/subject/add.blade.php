@extends('layout.app')

@section('content')
<div class="content-wrapper">
    @include('flush.message')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> @if($subject->id)
                Modify Subject
            @else
            Add new Subject
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
              <form action="{{route($subject->exists?'subject.update':'subject.store',$subject)}}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" value="{{old('name',$subject->name)}}" name="name" id="name" placeholder="Enter subject name">
                      </div>
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1" {{ $subject->status==1?'selected':'' }}>Active</option>
                        <option value="0" {{ $subject->status==0?'selected':'' }}>Not Active</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="type">Type</label>
                    <select name="type" id="type" class="form-control">
                        <option value="theory" {{ $subject->type=='theory'?'selected':'' }}>Theory</option>
                        <option value="practical" {{ $subject->type=='practical'?'selected':'' }}>Practical</option>
                    </select>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">
                    @if ($subject->id)
                        Modify
                    @else
                        Add
                    @endif
                </button>
                </div>
              </form>
            </div>
        </div>
      </div>
    </section>

  </div>
@endsection