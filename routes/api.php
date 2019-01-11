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

Route::post('responsible-process', 'AuditResponsibleController@responsibleProcess');
Route::get('report/pdf', 'AuditUniversityDegreePrintController@ReportPdf');

