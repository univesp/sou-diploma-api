<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resources([
    'document' => 'AuditDocumentController',
    'documentType' => 'AuditDocumentTypeController',
    'process' => 'AuditProcessController',
    'itemAuditProcess' => 'AuditItemProcessController',
    'printType' => 'AuditPrintTypeController',
    'responsible' => 'AuditResponsibleController',
    'type' => 'AuditTypeController',
    'university' => 'AuditUniversityDegreePrintController',
    'registration' => 'UniversityDegreeInformationController',
    'students' => 'StudentController',
    'addresses' => 'AddressController',
    'identities' => 'IdentityController',
    'parentages' => 'ParentageController',
]);

//Route to save and update data to sou_audit / audit_proccess
Route::post('responsible-process', 'AuditResponsibleController@responsibleProcess');

//Route to save and update print degree status
Route::patch('print-status', 'PrintListTempController@printStatus');
Route::patch('print-fail', 'PrintListTempController@printFail');

Route::get('prints/all', 'PrintListTempController@getStudentsDegreePrint');

Route::get('report/pdf', 'AuditUniversityDegreePrintController@ReportPdf');

//essa rota precisa do tipo 1 mãe , 2 pai
Route::put('parentages/{id}/{type}','ParentageController@update');

// Eduardo Oliveira
// Authentication
Route::get('/v_auditados', 'StudentController@auditStudents');
Route::get('/v_geral', 'StudentController@reserchStudents');
Route::get('/v_em_aberto', 'StudentController@openedStudents');
Route::get('/v_atribuidos', 'StudentController@attributedStudents');
Route::get('/v_dados_pessoais/{id_student}', 'StudentController@dataPersonalStudents');


Route::namespace('API')->name('api.')->group(function() {
    Route::prefix('prints')->group(function(){
        Route::get('/','PrintListTempController@index')->name('index_prints');
        //Route to  save and update print degree status
        //Route::patch('/status', 'PrintListTempController@printStatus');
        //Route::patch('/fail'  , 'PrintListTempController@printFail');
        Route::patch('update'  , 'PrintListTempController@update')->name('update_prints');
    });
});
