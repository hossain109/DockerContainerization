
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>


  </nav>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="javascript:void(0)" class="brand-link" style="text-align: center">
      <span class="brand-text font-weight-light ">School Management</span>
    </a>
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{url('public/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

       @if (Auth::user()->user_type==1)
        <li class="nav-item">
          <a href="{{url('admin/dashboard')}}" class="nav-link {{Request::segment(2)=='dashboard'?'active':''}}" >
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>>
        </li>
        <li class="nav-item">
          <a href="{{url('admin/admin/list')}}" class="nav-link {{Request::segment(2)=='admin'?'active':''}}" >
            <i class="nav-icon fas fa-user"></i>
            <p>
              Admin
            </p>
          </a>>
        </li>
        <li class="nav-item">
          <a href="{{url('admin/my-account')}}" class="nav-link {{Request::segment(2)=='my-account'?'active':''}}" >
            <i class="nav-icon fas fa-user"></i>
            <p>
              My Account
            </p>
          </a>>
        </li>
        <li class="nav-item">
          <a href="{{url('admin/change-password/add')}}" class="nav-link {{Request::segment(2)=='change-password'?'active':''}}" >
            <i class="nav-icon fas fa-user"></i>
            <p>
              Change Password
            </p>
          </a>>
        </li>
        <li class="nav-item">
          <a href="{{url('admin/student/list')}}" class="nav-link {{Request::segment(2)=='student'?'active':''}}" >
            <i class="nav-icon fas fa-user"></i>
            <p>
              Student
            </p>
          </a>>
        </li>
        <li class="nav-item">
          <a href="{{url('admin/teacher/list')}}" class="nav-link {{Request::segment(2)=='teacher'?'active':''}}" >
            <i class="nav-icon fas fa-user"></i>
            <p>
              Teacher
            </p>
          </a>>
        </li>
        <li class="nav-item">
          <a href="{{url('admin/parent/list')}}" class="nav-link {{Request::segment(2)=='parent'?'active':''}}" >
            <i class="nav-icon fas fa-user"></i>
            <p>
              Parent
            </p>
          </a>>
        </li>
        <li class="nav-item">
          <a href="{{url('admin/class/list')}}" class="nav-link {{Request::segment(2)=='class'?'active':''}}" >
            <i class="nav-icon fas fa-user"></i>
            <p>
              Class
            </p>
          </a>>
        </li>
        <li class="nav-item">
          <a href="{{url('admin/subject/list')}}" class="nav-link {{Request::segment(2)=='subject'?'active':''}}" >
            <i class="nav-icon fas fa-user"></i>
            <p>
              Subject
            </p>
          </a>>
        </li>
        <li class="nav-item">
          <a href="{{url('admin/teacher-class/list')}}" class="nav-link {{Request::segment(2)=='teacher-class'?'active':''}}" >
            <i class="nav-icon fas fa-user"></i>
            <p>
              Teacher-Class Assign
            </p>
          </a>>
        </li>
        <li class="nav-item">
          <a href="{{url('admin/subject-class/list')}}" class="nav-link {{Request::segment(2)=='subject-class'?'active':''}}" >
            <i class="nav-icon fas fa-user"></i>
            <p>
              Subject-Class Assign
            </p>
          </a>>
        </li>
           
       @elseif(Auth::user()->user_type==2)
        <li class="nav-item">
          <a href="{{url('teacher/dashboard')}}" class="nav-link {{Request::segment(2)=='dashboard'?'active':''}}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>>
        </li>
        <li class="nav-item">
          <a href="{{url('teacher/change-password/add')}}" class="nav-link {{Request::segment(2)=='change-password'?'active':''}}" >
            <i class="nav-icon fas fa-user"></i>
            <p>
              Change Password
            </p>
          </a>>
        </li>
        <li class="nav-item">
          <a href="{{url('teacher/my-account')}}" class="nav-link {{Request::segment(2)=='my-account'?'active':''}}" >
            <i class="nav-icon fas fa-user"></i>
            <p>
              My Account
            </p>
          </a>>
        </li>
        @elseif(Auth::user()->user_type==3)
        <li class="nav-item">
          <a href="{{url('student/dashboard')}}" class="nav-link {{Request::segment(2)=='dashboard'?'active':''}}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>>
        </li>
        <li class="nav-item">
          <a href="{{url('student/change-password/add')}}" class="nav-link {{Request::segment(2)=='change-password'?'active':''}}" >
            <i class="nav-icon fas fa-user"></i>
            <p>
              Change Password
            </p>
          </a>>
        </li>
        <li class="nav-item">
          <a href="{{url('student/my-account')}}" class="nav-link {{Request::segment(2)=='my-account'?'active':''}}" >
            <i class="nav-icon fas fa-user"></i>
            <p>
              My Account
            </p>
          </a>>
        </li>
        @elseif(Auth::user()->user_type==4)
        <li class="nav-item">
          <a href="{{url('parent/dashboard')}} " class="nav-link {{Request::segment(2)=='dashboard'?'active':''}}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>>
        </li>
        <li class="nav-item">
          <a href="{{url('parent/my-account')}}" class="nav-link {{Request::segment(2)=='my-account'?'active':''}}" >
            <i class="nav-icon fas fa-user"></i>
            <p>
              My Account
            </p>
          </a>>
        </li>
        <li class="nav-item">
          <a href="{{url('parent/my-student')}}" class="nav-link {{Request::segment(2)=='my-student'?'active':''}}" >
            <i class="nav-icon fas fa-user"></i>
            <p>
              My Student
            </p>
          </a>>
        </li>
        <li class="nav-item">
          <a href="{{url('parent/change-password/add')}}" class="nav-link {{Request::segment(2)=='change-password'?'active':''}}" >
            <i class="nav-icon fas fa-user"></i>
            <p>
              Change Password
            </p>
          </a>>
        </li>
       @endif
          <li class="nav-item">
            <a href="{{url('logout')}}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Logout
              </p>
            </a>>
          </li>
        </ul>
      </nav>
    </div>
  </aside>