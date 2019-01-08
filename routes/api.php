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
    'registration' => 'UniversityDegreeInformationController'
]);

Route::post('responsible-process', 'AuditResponsibleController@responsibleProcess');

Route::get('report/pdf', 'AuditUniversityDegreePrintController@ReportPdf');
Route::get('registration-index', 'UniversityDegreeInformationController@index');
Route::put('registration-update/{id}', 'UniversityDegreeInformationController@updateStudents');
