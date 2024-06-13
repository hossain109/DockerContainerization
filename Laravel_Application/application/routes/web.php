<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChangepasswordController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectClassController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherClassController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('login');
// });

Route::get('/',[AuthController::class,'login']);
Route::post('/login',[AuthController::class,'doLogin']);
Route::get('/logout',[AuthController::class,'logout']);
Route::get('/forget-password',[AuthController::class,'forgetPassword'])->name('form.password');
Route::post('/forget-password',[AuthController::class,'submitForgetPassword'])->name('submit.password');
Route::get('/reset/{token}',[AuthController::class,'reset']);
Route::post('/reset/{token}',[AuthController::class,'resetpost']);





Route::middleware('admin')->group(function(){

    Route::get('admin/dashboard',[DashboardController::class,'dashboard']);
    Route::get('admin/admin/list',[AdminController::class,'list'])->name('admin.list');
    Route::get('admin/admin/add',[AdminController::class,'add'])->name('admin.add');
    Route::post('admin/admin/add',[AdminController::class,'store'])->name('admin.store');
    Route::get('admin/admin/{admin}/modify',[AdminController::class,'modify'])->name('admin.modify');
    Route::post('admin/admin/{admin}/update',[AdminController::class,'update'])->name('admin.update');
    Route::post('admin/admin/{admin}/delete',[AdminController::class,'delete'])->name('admin.delete');
    //filtering admin
    Route::post('admin/search',[AdminController::class,'searchAdmin'])->name('admin.search');
    //class route
    Route::get('admin/class/list',[ClassController::class,'list'])->name('class.list');
    Route::get('admin/class/add',[ClassController::class,'add'])->name('class.add');
    Route::post('admin/class/add',[ClassController::class,'store'])->name('class.store');
    Route::get('admin/class/{class}/modify',[ClassController::class,'modify'])->name('class.modify');
    Route::post('admin/class/{class}/update',[ClassController::class,'update'])->name('class.update');
    Route::post('admin/class/{class}/delete',[ClassController::class,'delete'])->name('class.delete');
    //filtering class
    Route::post('admin/class/search',[ClassController::class,'searchClass'])->name('class.search');
    //route for student
    Route::get('admin/student/list',[StudentController::class,'list'])->name('student.list');
    Route::get('admin/student/add',[StudentController::class,'add'])->name('student.add');
    Route::post('admin/student/add',[StudentController::class,'store'])->name('student.store');
    Route::get('admin/student/{student}/modify',[StudentController::class,'modify'])->name('student.modify');
    Route::post('admin/student/{student}/update',[StudentController::class,'update'])->name('student.update');
    Route::post('admin/student/{student}/delete',[StudentController::class,'delete'])->name('student.delete');
    //filtering student
    Route::post('admin/student/search',[StudentController::class,'searchstudent'])->name('student.search');

    //routes for teacher
    Route::get('admin/teacher/list',[TeacherController::class,'list'])->name('teacher.list');
    Route::get('admin/teacher/add',[TeacherController::class,'add'])->name('teacher.add');
    Route::post('admin/teacher/add',[TeacherController::class,'store'])->name('teacher.store');
    Route::get('admin/teacher/{teacher}/modify',[TeacherController::class,'modify'])->name('teacher.modify');
    Route::post('admin/teacher/{teacher}/update',[TeacherController::class,'update'])->name('teacher.update');
    Route::post('admin/teacher/{teacher}/delete',[TeacherController::class,'delete'])->name('teacher.delete');
    //filtering teacher
    Route::post('admin/teacher/search',[TeacherController::class,'searchteacher'])->name('teacher.search');
    //route for parent
    Route::get('admin/parent/list',[ParentController::class,'list'])->name('parent.list');
    Route::get('admin/parent/add',[ParentController::class,'add'])->name('parent.add');
    Route::post('admin/parent/add',[ParentController::class,'store'])->name('parent.store');
    Route::get('admin/parent/{parent}/modify',[ParentController::class,'modify'])->name('parent.modify');
    Route::post('admin/parent/{parent}/update',[ParentController::class,'update'])->name('parent.update');
    Route::post('admin/parent/{parent}/delete',[ParentController::class,'delete'])->name('parent.delete');
    //parent student assign
    Route::get('admin/parent/{parent}/my-student',[ParentController::class,'mystudent'])->name('mystudent.parent');
    Route::get('admin/parent/{student}/{parent}/parent-assign',[ParentController::class,'parentassign'])->name('parents.assign');
    Route::get('admin/parent/student/{student}/delete',[ParentController::class,'parentStudentDelete'])->name('parentsstudent.delete');
    
    //filtering parent
    Route::post('admin/parent/search',[ParentController::class,'searchParent'])->name('parent.search');
    //subject route
    Route::get('admin/subject/list',[SubjectController::class,'list'])->name('subject.list');
    Route::get('admin/subject/add',[SubjectController::class,'add'])->name('subject.add');
    Route::post('admin/subject/add',[SubjectController::class,'store'])->name('subject.store');
    Route::get('admin/subject/{subject}/modify',[SubjectController::class,'modify'])->name('subject.modify');
    Route::post('admin/subject/{subject}/update',[SubjectController::class,'update'])->name('subject.update');
    Route::post('admin/subject/{subject}/delete',[SubjectController::class,'delete'])->name('subject.delete');
    //filtering subject
    Route::post('admin/subject/search',[SubjectController::class,'searchSubject'])->name('subject.search');
    //subject-class assign route
    Route::get('admin/subject-class/list',[SubjectClassController::class,'list'])->name('subclass.list');
    Route::get('admin/subject-class/add',[SubjectClassController::class,'add'])->name('subclass.add');
    Route::post('admin/subject-class/add',[SubjectClassController::class,'store'])->name('subclass.store');
    Route::get('admin/subject-class/{subclass}/modify',[SubjectClassController::class,'modify'])->name('subclass.modify');
    Route::post('admin/subject-class/{subclass}/update',[SubjectClassController::class,'update'])->name('subclass.update');
    Route::post('admin/subject-class/{subclass}/delete',[SubjectClassController::class,'delete'])->name('subclass.delete');
    //filtering class-subject
    Route::post('admin/subject-class/search',[SubjectClassController::class,'searchsubclass'])->name('subclass.search');

    //class teacher assign
    Route::get('admin/teacher-class/list',[TeacherClassController::class,'list'])->name('teacherclass.list');
    Route::get('admin/teacher-class/add',[TeacherClassController::class,'add'])->name('teacherclass.add');
    Route::post('admin/teacher-class/add',[TeacherClassController::class,'store'])->name('teacherclass.store');
    Route::get('admin/teacher-class/{teacherclass}/modify',[TeacherClassController::class,'modify'])->name('teacherclass.modify');
    Route::post('admin/teacher-class/{teacherclass}/update',[TeacherClassController::class,'update'])->name('teacherclass.update');
    Route::post('admin/teacher-class/{teacherclass}/delete',[TeacherClassController::class,'delete'])->name('teacherclass.delete');



    //change password for admin
    Route::get('admin/change-password/add',[ChangepasswordController::class,'add']);
    Route::post('admin/change-password/add',[ChangepasswordController::class,'change'])->name('changepassword.add');
    //my account for admin
    Route::get('admin/my-account',[UserController::class,'myAccountAdmin']);
    Route::post('admin/my-account',[UserController::class,'updateMyAccountAdmin'])->name('admin.account');
});




Route::middleware('teacher')->group(function(){
    Route::get('teacher/dashboard',[DashboardController::class,'dashboard'])->name('teacher.dashboard');
    Route::get('teacher/change-password/add',[UserController::class,'changePassword']);
    Route::post('teacher/change-password/add',[UserController::class,'submitPassword']);
    Route::get('teacher/my-account',[UserController::class,'myAccountTeacher']);
    Route::post('teacher/my-account',[UserController::class,'updateMyAccountTeacher'])->name('teacher.account');
});

Route::middleware('student')->group(function(){
    Route::get('student/dashboard',[DashboardController::class,'dashboard']);
    Route::get('student/change-password/add',[UserController::class,'changePassword']);
    Route::post('student/change-password/add',[UserController::class,'submitPassword']);
    Route::get('student/my-account',[UserController::class,'myAccountStudent']);
    Route::post('student/my-account',[UserController::class,'updateMyAccountStudent'])->name('student.account');
});

Route::middleware('parent')->group(function(){
    Route::get('parent/dashboard',[DashboardController::class,'dashboard']);
    Route::get('parent/change-password/add',[UserController::class,'changePassword']);
    Route::post('parent/change-password/add',[UserController::class,'submitPassword']);
    Route::get('parent/my-account',[UserController::class,'myAccountParent']);
    Route::post('parent/my-account',[UserController::class,'updateMyAccountParent'])->name('parent.account');
    Route::get('parent/my-student',[UserController::class,'parentStudent'])->name('parent.student');
});