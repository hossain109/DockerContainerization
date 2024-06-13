@extends('layout.app')

@section('content')
<div class="content-wrapper">
    {{-- @include('flush.message') --}}
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> @if($student->id)
                Modify Student
            @else
            Add new Student
            @endif </h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <form action="{{route($student->exists?'student.update':'student.store',$student)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <label for="name">Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{old('name',$student->name)}}" name="name" id="name" placeholder="Enter last name">  
                            <div class="text-danger ms-2">{{ $errors->first('name') }}</div>
                          </div>                        
                          <div class="col-md-6">
                            <label for="first_name">First Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{old('first_name',$student->first_name)}}" name="first_name" id="first_name" placeholder="Enter first name">  
                            <div class="text-danger ms-2">{{ $errors->first('first_name') }}</div>
                          </div>                         
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <label for="admission_number">Admission number<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{old('admission_number',$student->admission_number)}}" name="admission_number" id="admission_number" placeholder="Enter admission number">  
                            <div class="text-danger ms-2">{{ $errors->first('admission_number') }}</div>
                          </div>
                          <div class="col-md-6">
                            <label for="roll_number">Roll Number<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{old('roll_number',$student->roll_number)}}" name="roll_number" id="roll_number" placeholder="Enter roll number">  
                            <div class="text-danger ms-2">{{ $errors->first('roll_number') }}</div>
                          </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <label for="class">Class<span style="color: red;">*</span></label>
                            <select name="class" id="class" class="form-control">
                              <option value="">Select Class</option>
                                  @foreach ($classes as $classe)
                                      <option value="{{$classe->id}}" {{ $classe->id==$student->classe_id?'selected':'' }}>{{$classe->name}}</option>
                                  @endforeach
                            </select>
                            <div class="text-danger ms-2">{{ $errors->first('class') }}</div>
                          </div>
                          <div class="col-md-6">
                            <label for="gender">Gender<span style="color: red;">*</span></label>
                            <select name="gender" id="gender" class="form-control">
                              <option value="">Select Class</option>
                              <option value="male" {{ $student->gender == 'male'?'selected':'' }} >Male</option>
                              <option value="female" {{ $student->gender == 'female'?'selected':'' }} >Female</option>
                              <option value="other" {{ $student->gender == 'other'?'selected':'' }}>Other</option>
                            </select>
                            <div class="text-danger ms-2">{{ $errors->first('gender') }}</div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <label for="dob">Date of Birth<span style="color: red;">*</span></label>
                              <input type="date" name="dob" id="dob" class="form-control" value="{{old('dob',$student->birth_date)}}">
                              <div class="text-danger ms-2">{{ $errors->first('dob') }}</div>
                          </div>
                          <div class="col-md-6">
                            <label for="status">Status<span style="color: red;">*</span></label>
                            <select name="status" id="status" class="form-control">
                              <option value="">Select Class</option>
                              <option value="0" {{ $student->status =='0'?'selected':'' }}>Active</option>
                              <option value="1" {{ $student->status =='1'?'selected':'' }}>In Active</option>
                            </select>
                            <div class="text-danger ms-2">{{ $errors->first('status') }}</div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <label for="mobile_number">Mobile Number<span style="color: red;">*</span></label>
                              <input type="number" name="mobile_number" id="mobile_number" class="form-control" value="{{old('mobile_number',$student->mobile_number)}}">
                              <div class="text-danger ms-2">{{ $errors->first('mobile_number') }}</div>
                            </div>                          
                          <div class="col-md-6">
                            <label for="admission_date">Admission Date<span style="color: red;">*</span></label>
                            <input type="date" name="admission_date" id="admission_date" class="form-control" value="{{old('admission_date',$student->admission_date)}}">
                            <div class="text-danger ms-2">{{ $errors->first('admission_date') }}</div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <label for="profile_pic">Profile Picture<span style="color: red;">*</span></label>
                              <input type="file" name="profile_pic" id="profile_pic" class="form-control" value="{{old('profile_pic',$student->profile_pic)}}">
                              <div class="text-danger ms-2">{{ $errors->first('profile_pic') }}</div>
                            </div>
                          <div class="col-md-6">
                            <label for="blood_group">Blood Group<span style="color: red;">*</span></label>
                            <input type="text" name="blood_group" id="blood_group" class="form-control" value="{{old('blood_group',$student->blood_group)}}">
                            <div class="text-danger ms-2">{{ $errors->first('blood_group') }}</div>
                          </div>                         
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <label for="height">Height<span style="color: red;">*</span></label>
                              <input type="text" name="height" id="height" class="form-control" value="{{old('height',$student->height)}}">
                              <div class="text-danger ms-2">{{ $errors->first('height') }}</div>
                            </div>                          
                          <div class="col-md-6">
                            <label for="weight">Weight<span style="color: red;">*</span></label>
                            <input type="text" name="weight" id="weight" class="form-control" value="{{old('weight',$student->weight)}}">
                            <div class="text-danger ms-2">{{ $errors->first('weight') }}</div>
                          </div>                          
                        </div>
                      </div>
                      <hr>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <label for="password">Password<span style="color: red;">*</span></label>
                              <input type="password" name="password" id="password" class="form-control" value="">
                              @if ($student->id)
                                  <span class="text-danger">Do you want to change password, please input new password !!</span>
                              @endif
                              <div class="text-danger ms-2">{{ $errors->first('password') }}</div>
                            </div>
                            <div class="col-md-6">
                              <label for="email">Email<span style="color: red;">*</span></label>
                                <input type="email" name="email" id="email" class="form-control" value="{{old('email',$student->email)}}">
                                <div class="text-danger ms-2">{{ $errors->first('email') }}</div>
                              </div>
                        </div>
                      </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">
                    @if ($student->id)
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