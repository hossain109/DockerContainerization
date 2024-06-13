@extends('layout.app')

@section('content')
<div class="content-wrapper">
    @include('flush.message')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> @if($subclass->id)
                Modify Subject Class
            @else
            Assign Subject Class
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
              <form action="{{route($subclass->exists?'subclass.update':'subclass.store',$subclass)}}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="class_id">Class Name</label>
                        {{-- @if ($classes->exists?) --}}
                        <select id="class_id"name="class_id" class="form-control">
                          @foreach ($classes as $class)
                            <option value="{{$class->id}}" {{$class->id == $subclass->classe_id?'selected':''}} >{{$class->name}}</option>
                          @endforeach                         
                        </select>
                        {{-- @endif --}}
                    </div>
                    <div class="form-group">
                      <label for="status">Status</label>
                      <select name="status" id="status" class="form-control">
                        <option value="0" {{ $subclass->status==0?'selected':'' }}>Not Active</option>
                          <option value="1" {{ $subclass->status==1?'selected':'' }}>Active</option>
                      </select>
                    </div>

                    <div class="form-group">
                    <label for="subject">Subjects</label>
                    @if (!empty($subjects))
                      @foreach ($subjects as $subject)
                        @php
                          $checked='';
                        @endphp
                        @if (!empty($subclass->classe->getAssignSub))
                           @foreach (($subclass->classe->getAssignSub) as $item)
                           
                            @if ($subject->id == $item->subject_id)
                            @php
                             $checked='checked';
                            @endphp
                            @endif
                           @endforeach
                        @endif
                      <div>
                        <label for=""><input type="checkbox" {{$checked}}  name="subject_id[]" id=""  value="{{$subject->id}}">{{$subject->name}}</label>
                      </div>
                        @endforeach
                      @endif
                    </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">
                    @if ($subclass->id)
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