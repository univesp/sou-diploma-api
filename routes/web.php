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
    //$a = new App\Services\StudentAuditProcess();

    //return $a->index();
    return view('welcome');
});

Route::get('/report/universityDegree/web', 'AuditUniversityDegreePrintController@universityDegreeWeb');
Route::get('/valida-diploma', 'StudentValidateDegree@show')->name('degree');
