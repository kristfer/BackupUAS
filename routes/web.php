<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

//prefix "admin"
Route::prefix('admin')->group(function() {

    //middleware "auth"
    Route::group(['middleware' => ['auth']], function () {

        //route dashboard
        Route::get('/dashboard', App\Http\Controllers\Admin\DashboardController::class)->name('admin.dashboard');

        //route resource lessons
        Route::resource('/mata_pelajaran', \App\Http\Controllers\Admin\mata_pelajaranController::class, ['as' => 'admin']);

        //route resource classrooms
        Route::resource('/kelas', \App\Http\Controllers\Admin\kelasController::class, ['as' => 'admin']);

        //route student import
        Route::get('/students/import', [\App\Http\Controllers\Admin\SiswaController::class, 'import'])->name('admin.students.import');

        //route student store import
        Route::post('/students/import', [\App\Http\Controllers\Admin\SiswaController::class, 'storeImport'])->name('admin.students.storeImport');

        //route resource students
        Route::resource('/students', \App\Http\Controllers\Admin\SiswaController::class, ['as' => 'admin']);


        //custom route for create question exam
        Route::get('/exams/{exam}/questions/create', [\App\Http\Controllers\Admin\UjianController::class, 'createQuestion'])->name('admin.exams.createQuestion');

        //custom route for store question exam
        Route::post('/exams/{exam}/questions/store', [\App\Http\Controllers\Admin\UjianController::class, 'storeQuestion'])->name('admin.exams.storeQuestion');


        //custom route for edit question exam
        Route::get('/exams/{exam}/questions/{question}/edit', [\App\Http\Controllers\Admin\UjianController::class, 'editQuestion'])->name('admin.exams.editQuestion');

        //custom route for update question exam
        Route::put('/exams/{exam}/questions/{question}/update', [\App\Http\Controllers\Admin\UjianController::class, 'updateQuestion'])->name('admin.exams.updateQuestion');

        //custom route for destroy question exam
        Route::delete('/exams/{exam}/questions/{question}/destroy', [\App\Http\Controllers\Admin\UjianController::class, 'destroyQuestion'])->name('admin.exams.destroyQuestion');

        //route student import
        Route::get('/exams/{exam}/questions/import', [\App\Http\Controllers\Admin\UjianController::class, 'import'])->name('admin.exam.questionImport');

        //route student import
        Route::post('/exams/{exam}/questions/import', [\App\Http\Controllers\Admin\UjianController::class, 'storeImport'])->name('admin.exam.questionStoreImport');

        //route resource exams
        Route::resource('/exams', \App\Http\Controllers\Admin\UjianController::class, ['as' => 'admin']);

        //custom route for enrolle create
        Route::get('/exam_sessions/{exam_session}/enrolle/create', [\App\Http\Controllers\Admin\SesiUjianController::class, 'createEnrolle'])->name('admin.exam_sessions.createEnrolle');

        //custom route for enrolle store
        Route::post('/exam_sessions/{exam_session}/enrolle/store', [\App\Http\Controllers\Admin\SesiUjianController::class, 'storeEnrolle'])->name('admin.exam_sessions.storeEnrolle');
        //route resource exam_sessions
        Route::resource('/exam_sessions', \App\Http\Controllers\Admin\SesiUjianController::class, ['as' => 'admin']);
    });
});
