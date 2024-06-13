@extends('layout.app')

@section('content')
<div class="content-wrapper">
    {{-- @include('flush.message') --}}
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>My Account</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <form action="{{route('student.account')}}" method="post" enctype="multipart/form-data">
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
                            <label for="dob">Date of Birth<span style="color: red;">*</span></label>
                              <input type="date" name="dob" id="dob" class="form-control" value="{{old('dob',$student->birth_date)}}">
                              <div class="text-danger ms-2">{{ $errors->first('dob') }}</div>
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
                            <label for="mobile_number">Mobile Number<span style="color: red;">*</span></label>
                              <input type="number" name="mobile_number" id="mobile_number" class="form-control" value="{{old('mobile_number',$student->mobile_number)}}">
                              <div class="text-danger ms-2">{{ $errors->first('mobile_number') }}</div>
                            </div>                          
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <label for="profile_pic">Profile Picture<span style="color: red;">*</span></label>
                              <input type="file" name="profile_pic" id="profile_pic" class="form-control" value="{{old('profile_pic',$student->profile_pic)}}">
                              @if (!empty($student->profile_pic)) <img src="{{url('upload/image/'.$student->profile_pic)}}" alt=" teacher image" height="60" width="60"> @endif
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
                            <div class="col-md-12">
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