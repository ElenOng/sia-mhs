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
Route::group(['middleware' => ['guest']], function () {
	Route::get('/', function () {
		return view('login');
	})->name('/');

	Route::post('/login', 'AuthController@login');
});
Route::get('/logout', 'AuthController@logout');
Route::middleware(['auth'])->group(function () {
	Route::middleware(['role.admin'])->group(function () {
		Route::get('/beranda', 'DashboardController@index')->name('beranda');
		Route::get('/profil', 'DashboardController@edit')->name('profil');
		Route::patch('/changePassword', 'DashboardController@changePassword')->name('ubahPWD');
		//student
		Route::get('/students', 'StudentsController@index');
		Route::get('/students/create', 'StudentsController@create');
		Route::post('/students/store', 'StudentsController@store');
		Route::get('/students/edit/{id}', 'StudentsController@edit')->name('edit-students');
		Route::patch('/students/update/{id}', 'StudentsController@update');
		Route::get('/students/detail/{id}', 'StudentsController@show')->name('detail-students');
		Route::get('/students/deactive/{type}/{id}', 'StudentsController@destroy')->name('deactive-students');

		//teacher
		Route::get('/teachers', 'TeachersController@index');
		Route::get('/teachers/create', 'TeachersController@create');
		Route::post('/teachers/store', 'TeachersController@store');
		Route::get('/teachers/edit/{id}', 'TeachersController@edit')->name('edit-teachers');
		Route::patch('/teachers/update/{id}', 'TeachersController@update');
		Route::get('/teachers/deactive/{id}', 'TeachersController@deactive')->name('deactive-teachers');

		//Roles
		Route::get('/roles', 'RolesController@index');
		Route::get('/roles/create', 'RolesController@create');
		Route::post('/roles/store', 'RolesController@store');
		Route::get('/roles/edit/{id}', 'RolesController@edit')->name('edit-roles');
		Route::patch('/roles/update/{id}', 'RolesController@update');
		Route::get('/roles/deactive/{id}', 'RolesController@deactive')->name('deactive-roles');
		//Departments
		Route::get('/departments', 'DepartmentsController@index');
		Route::get('/departments/create', 'DepartmentsController@create');
		Route::post('/departments/store', 'DepartmentsController@store');
		Route::get('/departments/edit/{id}', 'DepartmentsController@edit')->name('edit-departments');
		Route::patch('/departments/update/{id}', 'DepartmentsController@update');
		Route::get('/departments/deactive/{id}', 'DepartmentsController@deactive')->name('deactive-departments');
		//Statuses
		Route::get('/statuses', 'StatusesController@index');
		Route::get('/statuses/create', 'StatusesController@create');
		Route::post('/statuses/store', 'StatusesController@store');
		Route::get('/statuses/edit/{id}', 'StatusesController@edit')->name('edit-statuses');
		Route::patch('/statuses/update/{id}', 'StatusesController@update');
		//Classes
		Route::get('/classes', 'ClassesController@index');
		Route::get('/classes/create', 'ClassesController@create');
		Route::post('/classes/store', 'ClassesController@store');
		Route::get('/classes/edit/{id}', 'classesController@edit')->name('edit-classes');
		Route::get('/classes/deactive/{id}', 'ClassesController@deactive')->name('deactive-classes');
		Route::get('/classes/detail/{id}', 'DetailClassessController@index')->name('detail-classes');
		Route::get('/classes/detail/create/{id}', 'DetailClassessController@create')->name('detail-create');
		Route::post('/classes/detail/store', 'DetailClassessController@store')->name('detail-store');
		Route::get('/classes/subject/{id}', 'DetailSubjectsController@index')->name('class-subject');
		Route::post('/classes/subject/store', 'DetailSubjectsController@store');
		Route::delete('/classes/subject/delete/{id}', 'DetailSubjectsController@destroy')->name('class-subject-delete');
		Route::delete('/classes/detail/delete/{id}', 'DetailClassessController@destroy')->name('class-detail-delete');

		//Lessons
		Route::get('/lessons', 'SubjectsController@index');
		Route::get('/lessons/create', 'SubjectsController@create');
		Route::post('/lessons/store', 'SubjectsController@store');
		Route::get('/lessons/show/{id}', 'SubjectsController@show')->name('show-subject');
		Route::get('/lessons/edit/{id}', 'SubjectsController@edit')->name('edit-subject');
		Route::patch('/lessons/update/{id}', 'SubjectsController@update')->name('update-subject');
		Route::get('/lessons/update/{id}', 'SubjectsController@destroy')->name('deactive-subject');

		Route::get('/score/{type}', 'ScoreController@index')->name('score-index');
		Route::get('/score/{type}/detail/{id}', 'ScoreController@detail')->name('score-detail');
		Route::get('/score/{type}/detail/{id}/create', 'ScoreController@create')->name('score-create');
		Route::post('/score/{type}/detail/store', 'ScoreController@store')->name('score-store');
		Route::get('/score/{type}/detail/{id}/edit/{find}', 'ScoreController@edit')->name('score-edit');
		Route::patch('/score/{type}/{find}/update', 'ScoreController@update')->name('score-update');
		Route::get('/score/{type}/detail/{id}/list/{find}', 'ScoreController@list')->name('score-list');
		Route::get('/score/{type}/detail/{id}/list/{find}/edit/score/{values_id}', 'ScoreController@edit_score')->name('score-list-edit');
		Route::get('/score/{type}/detail/{id}/list/{find}/score/{values_id}/edit', 'ScoreController@edit_score_list')->name('score-list-detail-edit');
		Route::patch('/score/{type}/detail/{id}/list/{find}/score/{values_id}/update', 'ScoreController@update_score')->name('score-list-update');

		//Report
		Route::get('/report/student/score/report', 'ReportController@LaporanNilaiSiswa')->name('report-student');
		Route::post('/report/student/score/report/class/{classses_id}', 'ReportController@LaporanNilaiSiswaKelas')->name('report-student-class-find');
		Route::get('/report/subject/score/report', 'ReportController@LaporanNilaiMataPelajaran')->name('report-subject');
		Route::post('/report/subject/score/report/class/{classes_id}', 'ReportController@LaporanNilaiMataPelajaranKelas')->name('report-subject-class');

		//download
		Route::get('/report/download/students/{students_id}/class/{classes_id}/subject/{subjects_id}/type/{types_id}', 'Downloads@downloadStudents')->name('download-students');
		Route::get('/report/download/students/{students_id}/class/{classes_id}/subject/{subjects_id}/type/{types_id}/pdf', 'Downloads@downloadStudents_pdf')->name('students-pdf');
		Route::get('/download/students/back', 'Downloads@downloadStudentsBack')->name('download-students-back');

		Route::get('/report/download/subjects/{subjects_id}/class/{classes_id}/type/{types_id}', 'Downloads@downloadSubjects')->name('download-subject');
		Route::get('/report/download/subjects/{subjects_id}/class/{classes_id}/type/{types_id}/pdf', 'Downloads@downloadSubjects_pdf')->name('subjects-pdf');
		Route::get('/download/subject/back', 'Downloads@downloadSubjectsBack')->name('download-subjects-back');
	});
	Route::middleware(['auth'])->group(function () {
		Route::middleware(['role.student'])->group(function () {
			//students view
			Route::get('/students/view', 'StudentsViewController@index')->name('home-student');
			Route::get('/students/view/{students_id}', 'StudentsViewController@profile')->name('profile-student');
			Route::get('/students/view/{students_id}/edit', 'StudentsViewController@edit')->name('profile-edit');
			Route::patch('/students/view/{students_id}/update', 'StudentsViewController@update')->name('profile-update');
			route::post('/students/view/{students_id}/class/{classes_id}', 'StudentsViewController@class_detail')->name('class-detail');
			Route::get('/students/view/{students_id}/changePassword', 'StudentsViewController@changePassword')->name('changePassword');
			Route::patch('/students/view/changePassword', 'StudentsViewController@change_password')->name('changePWD');
		});
	});
});
// Route::get('/test', 'Downloads@test')->name('download-students');
