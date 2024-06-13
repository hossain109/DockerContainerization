@extends('layout.app')

@section('content')
<div class="content-wrapper">
    @include('flush.message')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> @if($teacherclass->id)
                Modify Teacher Class
            @else
            Assign Teacher Class
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
              <form action="{{route($teacherclass->exists?'teacherclass.update':'teacherclass.store',$teacherclass)}}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="class_id">Class Name</label>
                        @if (!empty($classes))
                        <select id="class_id"name="class_id" class="form-control">
                          @foreach ($classes as $class)
                            <option value="{{$class->id}}" {{$class->id == $teacherclass->classe_id?'selected':''}} >{{$class->name}}</option>
                          @endforeach                         
                        </select>
                        @endif
                    </div>
                    <div class="form-group">
                      <label for="status">Status</label>
                      <select name="status" id="status" class="form-control">
                        <option value="0" {{ $teacherclass->status==0?'selected':'' }}>Not Active</option>
                          <option value="1" {{ $teacherclass->status==1?'selected':'' }}>Active</option>
                      </select>
                    </div>

                    <div class="form-group">
                    <label for="subject">Teacher</label>
                    @if (!empty($teachers))
                      @foreach ($teachers as $teacher)
                        @php
                          $checked='';
                        @endphp

                      @if (!empty($teacherclass))
                        @if ($teacherclass->user_id == $teacher->id)
                            @php
                                $checked='checked';
                            @endphp
                        @endif
                      @endif
                        {{-- @if (!empty($teacherclass->classe->getAssignTeacher))
                           @foreach (($teacherclass->classe->getAssignTeacher) as $item)
                           
                            @if ($user->id == $item->user_id)
                            @php
                             $checked='checked';
                            @endphp
                            @endif
                           @endforeach
                        @endif --}}
                      <div>
                        <label for=""><input type="checkbox" {{$checked}}  name="user_id[]" id=""  value="{{$teacher->id}}">{{$teacher->name}}</label>
                      </div>
                        @endforeach
                      @endif
                    </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">
                    @if ($teacherclass->id)
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