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
    'parentages' => 'ParentageController'
]);

//Route to save and update dtaa to sou_audit / audit_proccess
Route::post('responsible-process', 'AuditResponsibleController@responsibleProcess');

//Route to  save and update print degree status
Route::patch('print-status', 'PrintListTempController@printStatus');

Route::get('report/pdf', 'AuditUniversityDegreePrintController@ReportPdf');

