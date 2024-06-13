@extends('layout.app')

@section('content')
<div class="content-wrapper">
    {{-- @include('flush.message') --}}
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Teacher Account</h1>
          </div>
        </div>
      </div>
    </section>
    @include('flush.message')
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <form action="{{route('teacher.account')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <label for="name">Last Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{old('name',$teacher->name)}}" name="name" id="name" placeholder="Enter teacher last name">  
                            <div class="text-danger ms-2">{{ $errors->first('name') }}</div>
                          </div>                        
                          <div class="col-md-6">
                            <label for="first_name">First Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{old('first_name',$teacher->first_name)}}" name="first_name" id="first_name" placeholder="Enter first name">  
                            <div class="text-danger ms-2">{{ $errors->first('first_name') }}</div>
                          </div>                         
                        </div>
                    </div>
                     <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <label for="marital_status">Marital Status<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="marital_status" id="marital_status" value="{{old('marital_status',$teacher->marital_status)}}" placeholder="Select your marital status">
                            <div class="text-danger ms-2">{{ $errors->first('marital_status') }}</div>
                          </div>
                          <div class="col-md-6">
                            <label for="gender">Gender<span style="color: red;">*</span></label>
                            <select name="gender" id="gender" class="form-control">
                              <option value="">Select Gender</option>
                              <option value="male" {{ $teacher->gender == 'male'?'selected':'' }} >Male</option>
                              <option value="female" {{ $teacher->gender == 'female'?'selected':'' }} >Female</option>
                              <option value="other" {{ $teacher->gender == 'other'?'selected':'' }}>Other</option>
                            </select>
                            <div class="text-danger ms-2">{{ $errors->first('gender') }}</div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <label for="dob">Date of Birth<span style="color: red;">*</span></label>
                              <input type="date" name="dob" id="dob" class="form-control" value="{{old('dob',$teacher->birth_date)}}">
                              <div class="text-danger ms-2">{{ $errors->first('dob') }}</div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <label for="mobile_number">Mobile Number<span style="color: red;">*</span></label>
                              <input type="number" name="mobile_number" id="mobile_number" class="form-control" value="{{old('mobile_number',$teacher->mobile_number)}}">
                              <div class="text-danger ms-2">{{ $errors->first('mobile_number') }}</div>
                            </div>  
                            <div class="col-md-6">
                              <label for="profile_pic">Profile Picture</label>
                                <input type="file" name="profile_pic" id="profile_pic" class="form-control" value="{{old('profile_pic',$teacher->profile_pic)}}">
                                @if (!empty($teacher->profile_pic)) <img src="{{url('upload/image/'.$teacher->profile_pic)}}" alt=" teacher image" height="60" width="60"> @endif
                                <div class="text-danger ms-2">{{ $errors->first('profile_pic') }}</div>
                              </div>                        
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <label for="qualification">Qualification<span style="color: red;">*</span></label>
                            <textarea name="qualification" id="qualification" class="form-control" cols="30" rows="3">{{old('qualification',$teacher->qualification)}}</textarea>
                            <div class="text-danger ms-2">{{ $errors->first('qualification') }}</div>
                          </div>
                            <div class="col-md-6">
                              <label for="work_experience">Work experience<span style="color: red;">*</span></label>
                              <textarea name="work_experience" class="form-control"  id="work_experience" cols="30" rows="3">{{old('work_experience',$teacher->work_experience)}}</textarea>
                                <div class="text-danger ms-2">{{ $errors->first('work_experience') }}</div>
                            </div>                         
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <label for="permanent_address">Permanent Adress<span style="color: red;">*</span></label>
                              <input type="text" name="permanent_address" id="permanent_address" class="form-control" placeholder="Enter permanent address" value="{{old('permanent_address',$teacher->permanent_adress)}}">
                              <div class="text-danger ms-2">{{ $errors->first('permanent_address') }}</div>
                            </div>
                        
                        <div class="col-md-6">
                            <label for="address">Current Adress<span style="color: red;">*</span></label>
                              <input type="text" name="address" id="address" class="form-control" placeholder="Enter current address" value="{{old('address',$teacher->address)}}">
                              <div class="text-danger ms-2">{{ $errors->first('address') }}</div>
                            </div>
                        </div>
                      </div>
                      <hr>
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                              <label for="email">Email<span style="color: red;">*</span></label>
                                <input type="email" name="email" id="email" class="form-control" value="{{old('email',$teacher->email)}}">
                                <div class="text-danger ms-2">{{ $errors->first('email') }}</div>
                              </div>
                        </div>
                      </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>

        </div>
      </div>
    </section>
  </div>
@endsection