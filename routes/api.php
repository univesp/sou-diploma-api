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
]);

Route::post('responsible-process', 'AuditResponsibleController@responsibleProcess');