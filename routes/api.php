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
]);

Route::patch('parentages/{id}/{type}', 'ParentageController@update');
Route::get('parentages/{id}', 'ParentageController@show');
Route::get('emails/{id}', 'EmailController@show');
Route::patch('emails/{id}/{type}', 'EmailController@update');

//Route to save and update data to sou_audit / audit_proccess
Route::post('responsible-process', 'AuditResponsibleController@responsibleProcess');

//Route to save and update print degree status
Route::patch('print-status', 'PrintListTempController@printStatus');
Route::patch('print-fail', 'PrintListTempController@printFail');

Route::get('prints/all', 'PrintListTempController@getStudentsDegreePrint');

Route::get('report/pdf', 'AuditUniversityDegreePrintController@ReportPdf');

//essa rota precisa do tipo 1 mãe , 2 pai
Route::put('parentages/{id}/{type}', 'ParentageController@update');

// Eduardo Oliveira
// Authentication
Route::get('/v_auditados', 'StudentController@auditStudents');
Route::get('/v_diplomados', 'StudentController@degreeStudents');
Route::get('/v_geral', 'StudentController@reserchStudents');
Route::get('/v_em_aberto', 'StudentController@openedStudents');
Route::get('/v_atribuidos', 'StudentController@attributedStudents');
Route::get('/v_retidos', 'StudentController@retained');
Route::get('/v_dados_pessoais/{academic_register}', 'StudentController@dataPersonalStudents');
Route::get('/v_orgao_emissor/{id?}', 'StudentController@organIssuing');
Route::get('/v_nacionalidade/{id?}', 'StudentController@nationality');
Route::get('/v_dados_ingressos/{academic_register?}', 'StudentController@ticketData');
Route::get('/v_cidade/{id?}', 'StudentController@city');
Route::get('/v_estados/{id?}', 'StudentController@states');
