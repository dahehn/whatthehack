<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome_new');
});
Route::get('/agb', function () {
    return view('subpages/agb');
});
Route::get('/contact', function () {
    return view('subpages/contact');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/challenges','ChallengeController@index')->name('challenges.index');
Route::get('/classroom', 'ClassroomController@index')->name('classroom.index');

// User Profile Routes
Route::get('/profile', 'ProfileController@show')->name('profile.show');
Route::get('/profile/changePassword', 'ProfileController@showChangePWForm')->name('profile.showChangePWForm');
Route::post('/profile/password/change', 'ProfileController@changePW')->name('password.change');
Route::get('/profile/changeEmail', 'ProfileController@showChangeEMForm')->name('profile.showChangeEMForm');
Route::post('/profile/email/change', 'ProfileController@changeEM')->name('email.change');
Route::delete('/profile/delete/{user}', 'ProfileController@deleteAccount')->name('profile.delete');

// Challenge Routes
Route::get('challenges/create', 'ChallengeController@create')->name('challenges.create');
Route::post('challenges', 'ChallengeController@store')->name('challenges.store');
Route::get('challenges/{challenge}','ChallengeController@show')->name('challenges.show');

Route::get('challenges/edit/{challenge}','ChallengeController@edit')->name('challenges.edit');
Route::patch('challenges/update/{challenge}','ChallengeController@update')->name('challenges.update');
Route::delete('challenges/delete/{challenge}','ChallengeController@destroy')->name('challenges.destroy');
Route::get('challenges/deactivate/{challenge}','ChallengeController@deactivate')->name('challenges.deactivate');
Route::get('challenges/files/{challenge}','ChallengeController@files')->name('challenges.files');
Route::post('challenges/upload/{challenge}','ChallengeController@upload')->name('challenges.upload');
Route::get('challenges/download/{challenge}','ChallengeController@download')->name('challenges.download');

// User Management Routes
Route::get('/manage/users', 'ManageUserController@index')->name('manageuser.index');
Route::patch('/manage/users/update/{user}', 'ManageUserController@update')->name('manageuser.update');

// Classroom Management Routes
Route::get('classroom/create', 'ClassroomController@create')->name('classroom.create');
Route::post('classroom', 'ClassroomController@store')->name('classroom.store');
Route::get('classroom/edit/{classroom}','ClassroomController@edit')->name('classroom.edit');
Route::get('classrooms/myClassrooms', 'ClassroomController@myClassrooms')->name('classroom.myclassrooms');
Route::patch('classroom/update/{classroom}', 'ClassroomController@update')->name('classroom.update');
Route::get('classroom/editMembers/{classroom}', 'ClassroomController@editMembers')->name('classroom.editmembers');

Route::get('classroom/editChallenges/{classroom}', 'ClassroomController@editChallenges')->name('classroom.editchallenges');
Route::post('classroom/updateMembers/{classroom}', 'ClassroomController@updateMembers')->name('classroom.updatemembers');
Route::patch('classroom/updateChallenges/{classroom}', 'ClassroomController@updateChallenges')->name('classroom.updatechallenges');
Route::patch('classroom/deleteMembers/{classroom}', 'ClassroomController@deleteMembers')->name('classroom.deleteMembers');

//add and remove challenges from  and to a classroom
Route::post('classroom/{classroom}/attach','ClassroomController@attach')->name('classroom.attach');
Route::delete('classroom/{classroom}/detach','ClassroomController@detach')->name('classroom.detach');
