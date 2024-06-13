@extends('layout.app')

@section('content')
<div class="content-wrapper">
    {{-- @include('flush.message') --}}
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Parent Modify</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <form action="{{route('parent.account')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <label for="name">Last Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{old('name',$parent->name)}}" name="name" id="name" placeholder="Enter last name">  
                            <div class="text-danger ms-2">{{ $errors->first('name') }}</div>
                          </div>                        
                          <div class="col-md-6">
                            <label for="first_name">First Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{old('first_name',$parent->first_name)}}" name="first_name" id="first_name" placeholder="Enter first name">  
                            <div class="text-danger ms-2">{{ $errors->first('first_name') }}</div>
                          </div>                         
                        </div>
                    </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <label for="occupation">Occupation<span style="color: red;">*</span></label>
                              <input type="text" name="occupation" id="occupation" class="form-control" value="{{old('dob',$parent->occupation)}}" placeholder="Enter occupation">
                              <div class="text-danger ms-2">{{ $errors->first('occupation') }}</div>
                          </div>

                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <label for="mobile_number">Mobile Number<span style="color: red;">*</span></label>
                              <input type="text" name="mobile_number" id="mobile_number" class="form-control" value="{{old('mobile_number',$parent->mobile_number)}}" placeholder="Enter mobile number">
                              <div class="text-danger ms-2">{{ $errors->first('mobile_number') }}</div>
                            </div>
                            <div class="col-md-6">
                                <label for="gender">Gender<span style="color: red;">*</span></label>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="">Select Class</option>
                                    <option value="male" {{ $parent->gender =='male'?'selected':'' }}>Male</option>
                                    <option value="female" {{ $parent->gender =='female'?'selected':'' }}>Female</option>
                                    <option value="other" {{ $parent->gender =='other'?'selected':'' }}>Other</option>
                                </select>
                                <div class="text-danger ms-2">{{ $errors->first('gender') }}</div>
                            </div>                         
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <label for="profile_pic">Profile Picture<span style="color: red;">*</span></label>
                              <input type="file" name="profile_pic" id="profile_pic" class="form-control" value="{{old('profile_pic',$parent->profile_pic)}}">
                              @if (!empty($parent->profile_pic)) <img src="{{url('upload/image/'.$parent->profile_pic)}}" alt="parent image" height="60" width="60"> @endif
                              <div class="text-danger ms-2">{{ $errors->first('profile_pic') }}</div>
                            </div> 
                            <div class="col-md-6">
                                <label for="address">Address<span style="color: red;">*</span></label>
                                  <input type="text" name="address" id="address" class="form-control" value="{{old('address',$parent->address)}}" placeholder="Enter address">
                                  <div class="text-danger ms-2">{{ $errors->first('address') }}</div>
                            </div>                         
                        </div>
                      </div>
                      <hr>
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                              <label for="email">Email<span style="color: red;">*</span></label>
                                <input type="email" name="email" id="email" class="form-control" value="{{old('email',$parent->email)}}" placeholder="Enter email">
                                <div class="text-danger ms-2">{{ $errors->first('email') }}</div>
                              </div>
                        </div>
                      </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">
                    @if ($parent->id)
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